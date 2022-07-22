<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile{user}", name="app_profile")
     */
    public function profile(User $user, ManagerRegistry $doctrine): Response
    {
        /* $entityManager = $doctrine->getManager();
        $repo = $entityManager->getRepository(User::class);
        $user = $repo->findOneBy(array('id' => $id)); */
        
        return $this->render('profile/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
