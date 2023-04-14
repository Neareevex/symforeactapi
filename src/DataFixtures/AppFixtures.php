<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture {

    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
   public function load(ObjectManager $manager) {
    $faker = Factory::create('fr_FR');
    
    $user = new User();
    $hash = $this->encoder->hashPassword($user, 'password');
    $user->setEmail('aleth@aleth.fr')
            ->setIsAuthor(false)
            ->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
   } 
}