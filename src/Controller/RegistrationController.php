<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\userType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    public function registroUsuario()
    {
        $usuario = new User();

        $FORMA=$this->createForm(userType::class, $usuario, array('method'=>'POST', 'action'=>$this->generateUrl('user_registration')) );
        return $this->render('registration/register.html.twig', array('form'=>$FORMA->createView()));
    }
    
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $txtPassword=$request->get('user')['password']['first'];
        // 1) Construimos el formulario
        $user = new User();
        $form = $this->createForm(userType::class, $user);

        // 2) Manejamos el envío (sólo pasará con POST)
        $form->handleRequest($request);       

        try 
        {
            if ($form->isSubmitted() && $form->isValid())
            {

                // 3) Codificamos el password (también se puede hacer a través de un Doctrine listener)
                $password = $encoder->encodePassword($user, $txtPassword);
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($password);
                $user->setIsActive(false);

                // 4) Guardar el User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // ... hacer cualquier otra cosa, como enviar un email, etc
                // establecer un mensaje "flash" de éxito para el usuario

                return $this->redirectToRoute('login_route');

            }

            return $this->render('registration/register.html.twig', array('form' => $form->createView()));
        } 
        catch (\Exception $e) 
        {
            $this->addFlash('mensaje', 'El usuario o el email ya se encuentran registrados en nuestras bases de datos');
            return $this->render('registration/register.html.twig', array('form' => $form->createView()));

        }
            

            
       
    }
}
