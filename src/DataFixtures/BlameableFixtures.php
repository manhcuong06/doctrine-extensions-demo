<?php

namespace App\DataFixtures;

use App\Entity\Blameable;
use Doctrine\Persistence\ObjectManager;

class BlameableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('blameables.json', Blameable::class);

        parent::load($manager);
    }
}
