<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dataset = [
            ['name' => 'drame',],
            ['name' => 'romance',],
            ['name' => 'thriller',],
            ['name' => 'horreur',],
            ['name' => 'action',],

        ];

        foreach($dataset as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $manager->persist($category);

            $this->addReference($data['name'], $category);
        }

        $manager->flush();
    }
}

        // $product = new Product();
        // $manager->persist($product);