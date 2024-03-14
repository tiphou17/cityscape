<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');
        // for ($i = 0; $i < 5; $i++) {
        //     $rent = new Rent();
        //     $rent->setRentStart($faker->dateTime());
        //     $rent->setRentEnd($faker->dateTime());
        //     $rent->setRentPrice($faker->randomFloat(2, 1, 10000));


        //     $manager->persist($rent);
        // }
        $manager->flush();
    }
}
