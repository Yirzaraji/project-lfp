<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PrivateMessage;
use App\Form\PrivateMessageType;
use Doctrine\Persistence\ManagerRegistry;
use ProxyManager\ProxyGenerator\ValueHolder\MethodGenerator\Constructor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrivateMessageController extends AbstractController
{
   
    /**
     * @Route("/pm{recipient}", name="app_private_message")
     */
    public function privateMessage(User $recipient, Request $request, ManagerRegistry $doctrine): Response
    {
        $test = $recipient->getReceiver();
        $message = new PrivateMessage();
        $form = $this->createForm(PrivateMessageType::class, $message);
        $form->handleRequest($request);  
        
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTimeImmutable();

            $message->setSender($this->getUser())
                    ->setSentAt($date)
                    ->setRecipient($recipient);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('app_home_page');
        }


        return $this->render('private_message/pm.html.twig', [
            'form' => $form->createView(),
            'recipient_messages' => $recipient,
            'current_user_messages' => $message,
            'test' => $test
        ]);
    }
}
