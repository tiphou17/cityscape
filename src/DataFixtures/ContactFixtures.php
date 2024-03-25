<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $contact = new Contact();
            $contact->setFullName($faker->name());
            $contact->setEmail($faker->email);
            $contact->setSubject('Demande n°' . ($i + 1));
            $contact->setPhoneNumber($faker->phoneNumber);
            $contact->setMessage($faker->text);
            $manager->persist($contact);
        }


        $manager->flush();
    }

}
