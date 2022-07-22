<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\PrivateMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrivateMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class, [
                'attr' =>[   
                    'class' => 'form-control'
                ]
            ])
           /* ->add('recipient', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'id',
                'attr' => [   
                    'class' => 'form-control',
                ]
            ]) */
            ->add('Send', SubmitType::class,[
                'attr' => [   
                    'class' => 'btn btn-danger contactForm', 
                    'style' => 'color:white; font-weight:bold'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrivateMessage::class,
        ]);
    }
}
