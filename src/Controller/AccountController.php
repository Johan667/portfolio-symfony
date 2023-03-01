<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/account', name: 'app_account')]
    public function index(Request $request, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $editForm = $this->createForm(EditProfileType::class, $user);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->addFlash("message", "Informations modifiées avec succès.");
        }


        return $this->render('account/index.html.twig', [
            'user' => $user,
            'editProfileForm' => $editForm->createView(),
        ]);
    }

    #[Route('/account/delete', name: 'delete_account')]
    public function deleteAccount()
    {
        $user = $this->getUser();

        $newSession = new Session();
        $newSession->invalidate();

        $this->entityManager->remove($user);
        $this->entityManager->flush();
        $this -> addFlash ("message", "Compte supprimé avec succès.");

        return $this->redirectToRoute('app_home');
    }
}
