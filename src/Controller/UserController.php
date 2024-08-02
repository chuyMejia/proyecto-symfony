<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class UserController extends AbstractController
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Crear formulario
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        // Rellenar el objeto con los datos del formulario
        $form->handleRequest($request);

        // Comprobar si se envió el formulario
        if ($form->isSubmitted() && $form->isValid()) {
            // Modificar el objeto para agregar el rol 
            $user->setRole('ROLE_USER');
            $user->setCreateAt(new \Datetime('now'));
            
            // CIFRAR CONTRASEÑA Y GUARDAR EN OBJETO 
            $encodedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);

            // Persistir y guardar el usuario
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Redirigir o mostrar mensaje
            return $this->redirectToRoute('tasks'); // Cambia 'tasks' por la ruta deseada
        }

        // Renderizar el formulario
        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="user_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }

}
