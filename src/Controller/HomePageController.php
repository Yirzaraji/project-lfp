<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="app_home_page")
     */
    public function home(Request $request, ManagerRegistry $doctrine): Response
    {
        //$entityManager = $doctrine->getManager();
        $repo = $this->entityManager->getRepository(User::class);
        $users = $repo->findAllExceptCurrentUser($this->getUser());

        
        
        return $this->render('homepage.html.twig', [
            'users' => $users
        ]);
    }
}
