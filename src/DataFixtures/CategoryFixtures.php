<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            1 => [
                'title' => 'pages',
                'slug' => '',
                'description' => '',
                'parent' => [
                    1 => [
                        'property' => '',
                        'property_sideBar' => '',
                        'property_details' => '',
                        'add_new_listing' => '',
                        'about_us' => '',
                        'faq' => '',
                        'checkout' => '',
                        'cart' => '',
                        'rent_checkout' => ''
                    ]

                ]
            ],
            2 => [
                'title' => 'project',
                'slug' => '',
                'description' => '',
                'parent' => [
                    1 => [
                        'project' => '',
                        'project_details' => '',
                    ]

                ]
            ],
            3 => [
                'title' => 'blog',
                'slug' => '',
                'description' => '',
                'parent' => [
                    1 => [
                        'blog_classic' => '',
                        'blog_details' => '',
                    ]

                ]
            ]
        ];

        // $product = new Product();
        // $manager->persist($product);


        $manager->flush();
    }
}
