<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            // $address = new Address();
            // $address->setAddNbStreet($faker->randomNumber(2, true));
            // $address->setAddAddressLine1($faker->streetName());
            // $address->setAddAddressLine2($faker->secondaryAddress());
            // $address->setAddCity($faker->city());
            // $address->setAddState($faker->region());
            // $address->setAddZip($faker->postalcode());

            // $manager->persist($address);
        }
        $manager->flush();
    }
}
