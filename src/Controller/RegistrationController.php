<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // 1. Crée une nouvelle instance de l'entité Users
        $user = new Users();

        // 2. Crée le formulaire
        $form = $this->createForm(RegistrationFormType::class, $user);

        // 3. Traite la soumission du formulaire
        $form->handleRequest($request);

        // 4. Vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // 5. Hash le mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $role = $form->get('role')->getData();
            $user->setRole($role);


            // 6. Enregistre l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // 7. Redirige l'utilisateur après l'inscription
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
