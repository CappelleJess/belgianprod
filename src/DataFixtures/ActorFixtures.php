<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use DateTime;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dataset = [
            [
                'firstname' => 'Leonardo',
                'lastname' => 'DiCaprio',
                'birthday' => '1974-11-11',
                'gender' => 'h',
            ],
            [
                'firstname' => 'Elliot',
                'lastname' => 'Page',
                'birthday' => '1987-02-21',
                'gender' => 'h',
            ],
            [
                'firstname' => 'Sigourney',
                'lastname' => 'Weaver',
                'birthday' => '1949-10-08',
                'gender' => 'f',
            ],
            [
                'firstname' => 'Sebastian',
                'lastname' => 'Stan',
                'birthday' => '1989-08-13',
                'gender' => 'h',
            ],
            [
                'firstname' => 'Ian',
                'lastname' => 'Holm',
                'birthday' => '1931-09-31',
                'gender' => 'h',
            ],
            [
                'firstname' => 'Adam',
                'lastname' => 'Pearson',
                'birthday' => '1985-01-06',
                'gender' => 'h',
            ],

        ];

        foreach($dataset as $data) {
            $actor = new Actor();
            $actor->setFirstname($data['firstname']);
            $actor->setLastname($data['lastname']);
            $actor->setBirthday(DateTime::createFromFormat('Y-m-d',$data['birthday']));
            $actor->setGender($data['gender']);

            $manager->persist($actor);

            $this->addReference($data['firstname'].' '.$data['lastname'], $actor);
        }

        $manager->flush();
    }
}
