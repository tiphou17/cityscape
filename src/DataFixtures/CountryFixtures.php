<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $country = new Country();
            $country->setCtName($faker->country());


            $manager->persist($country);
        }
        $manager->flush();
    }

}
