<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
        
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User;

        $hash = $this->encoder->encodePassword($user, 'admin');
            $user->setHash($hash)
                ->setLogin('test');

        $user2 = new User;        
        $hash2 = $this->encoder->encodePassword($user, 'user');
        $user2->setHash($hash2)
             ->setLogin('testuser');
        
        $user3 = new User;        
        $hash3 = $this->encoder->encodePassword($user, 'admin');
        $user3->setHash($hash3)
              ->setLogin('testuser2');

        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->flush();
    }
}
