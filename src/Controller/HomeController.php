<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(MailerInterface $mailer,Request $request): Response
    {
        /** Parti apercu de mes projets */

        $projects = $this->entityManager->getRepository(Project::class)->findBy([], ['createdAt' => 'DESC'], 3);

        /** Parti formulaire de contact */

        $contact = $this->createForm(ContactType::class);
        $contact->handleRequest($request);

        if ($contact->isSubmitted() && $contact->isValid()) {
            $mail = (new Email())
                ->from($contact->get('email')->getData())
                ->to(new Address('johankasripro67@gmail.com', 'Johan Kasri'))
                ->text($contact->get('content')->getData());
            $mailer->send($mail);

            $this->addFlash('message', 'Votre demande à bien été prise en compte ! ');
        }
        return $this->render('home/index.html.twig', [

        'contact'=>$contact->createView(),
        ]);
    }
}
