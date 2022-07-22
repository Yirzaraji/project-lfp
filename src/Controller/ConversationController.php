<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConversationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/conversations", name="app_conversations")
     */
    public function conversations(): Response
    {
        $repo = $this->entityManager->getRepository(User::class);
        $users = $repo->findAllExceptCurrentUser($this->getUser());

        return $this->render('conversation/conversations.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/conversation/{id}", name="app_conversation")
     */
    public function conversation(): Response
    {
        return $this->render('conversation/conversation.html.twig', [
            
        ]);
    }
}
