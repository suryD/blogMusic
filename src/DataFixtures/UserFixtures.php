<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setUsername('user_' . $i);
            $user->setPassword('password_' . $i);

            $manager->persist($user);

            // Ajoutez une référence pour chaque utilisateur créé
            $this->addReference('user_' . $i, $user);

        }
    }
}