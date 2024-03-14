<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Amenity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AmenityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            // $amenity = new Amenity();
            // $amenity->setAmenDishwasher($faker->boolean());
            // $amenity->setAmenFloorCoverings($faker->boolean());
            // $amenity->setAmenInternet($faker->boolean());
            // $amenity->setAmenKidsZone($faker->boolean());
            // $amenity->setAmenSupermarket($faker->boolean());
            // $amenity->setAmenWardrobes($faker->boolean());



            // $manager->persist($amenity);
        }
        $manager->flush();
    }
}
