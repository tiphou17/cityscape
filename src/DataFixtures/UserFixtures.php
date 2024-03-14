<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles($faker->randomElements(['admin', 'client']));
            $user->setPassword($faker->password());
            $user->setIsVerified($faker->boolean());
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setUserName($faker->userName());

            $manager->persist($user);
        }

        $manager->flush();
    }
}
