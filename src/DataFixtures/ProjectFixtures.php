<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $project = new project();
            $project->setProjClient($faker->name());
            $project->setProjPrice($faker->randomNumber());
            $project->setProjCategory($faker->word());
            $project->setProjDate($faker->dateTime());
            $project->setProjTitle($faker->word());
            $project->setProjFacebook($faker->word());
            $project->setProjTwitter($faker->word());
            $project->setProjLinkedin($faker->word());
            $project->setProjInstagram($faker->word());


            $manager->persist($project);
        }
        $manager->flush();
    }
}
