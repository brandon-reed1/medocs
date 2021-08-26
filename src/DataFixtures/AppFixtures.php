<?php

namespace App\DataFixtures;

use App\Entity\Day;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $days_names = [
            "tous les jours",
            "un jour sur deux",
            "deux fois par semaine",
            "trois fois par semaine",
            "lundi",
            "mardi",
            "mercredi",
            "jeudi",
            "vendredi",
            "samedi",
            "dimanche"
        ];

        foreach ($days_names as $name):
            $day = new Day();
            $day->setName($name);
            $manager->persist($day);
        endforeach;

        $manager->flush();
    }
}
