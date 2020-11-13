<?php

namespace App\DataFixtures;

use App\Entity\Tree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $food = new Tree();
        $food->setTitle('Food');
        $manager->persist($food);

        $fruits = new Tree();
        $fruits->setTitle('Fruits');
        $fruits->setParent($food);
        $manager->persist($fruits);

        $vegetables = new Tree();
        $vegetables->setTitle('Vegetables');
        $vegetables->setParent($food);
        $manager->persist($vegetables);

        $carrots = new Tree();
        $carrots->setTitle('Carrots');
        $carrots->setParent($vegetables);
        $manager->persist($carrots);

        $manager->flush();
    }
}
