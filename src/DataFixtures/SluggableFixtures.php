<?php

namespace App\DataFixtures;

use App\Entity\Sluggable;
use Doctrine\Persistence\ObjectManager;

class SluggableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('sluggables.json', Sluggable::class);

        parent::load($manager);
    }
}
