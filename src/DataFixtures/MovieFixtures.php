<?php

namespace App\DataFixtures;

use App\Entity\Movie;
//use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dataset = [
            [
                'title' => 'Inception',
                'description' =>'L\'histoire d\'un braquage dans un rêve.',
                'category' => 'action',
                'actors' => [
                    [
                        'firstname' => 'Leonardo',
                        'lastname' => 'DiCaprio',
                    ],
                    [
                        'firstname' => 'Elliot',
                        'lastname' => 'Page',
                    ],
                ],
            ],
            [
                'title' => 'Alien',
                'description' =>'Un huitième passager sème la panique à bord du Nostromos.',
                'category' => 'horreur',
                'actors' => [
                    [
                        'firstname' => 'Sigourney',
                        'lastname' => 'Weaver',
                    ],
                    [
                        'firstname' => 'Ian',
                        'lastname' => 'Holm',
                    ],
                ],
            ],
            [
                'title' => 'A Different Man',
                'description' =>'Suite à une opération expérimentale, Edward voit son physique changer, commence alors une fixation sur son ancien lui.',
                'category' => 'drame',
                'actors' => [
                    [
                        'firstname' => 'Sebastian',
                        'lastname' => 'Stan',
                    ],
                    [
                        'firstname' => 'Adam',
                        'lastname' => 'Pearson',
                    ],
                ],
            ],
            [
                'title' => 'Skinamarink',
                'description' =>'Deux enfants sont piégés dans leur maison, confrontés à des événements surnaturels de plus en plus terrifiants.',
                'category' => 'horreur',
                'actors' => [],
            ],

        ];

        foreach($dataset as $data) {
            //Retrouver la catégorie du film
            //$category = $manager->getRepository(Category::class)->findOneByName($data['category']);
            $category = $this->getReference($data['category']);
            
            //Créer le film
            $movie = new Movie();
            $movie->setTitle($data['title']);
            $movie->setDescription($data['description']);
            $movie->setCategory($category);

            foreach($data['actors'] as $d) {
                $actor = $this->getReference($d['firstname'].' '.$d['lastname']);

                $movie->addActor($actor);
            }
            

            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [
            CategoryFixtures::class,
            ActorFixtures::class,
        ];
    }
}
