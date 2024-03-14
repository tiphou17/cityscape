<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Feature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FeatureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            // $feature = new Feature();
            // $feature->setFeatTitle($faker->sentence(7));


            // $manager->persist($feature);
        }
        $manager->flush();
    }
}
