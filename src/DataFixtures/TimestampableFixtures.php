<?php

namespace App\DataFixtures;

use App\Entity\Timestampable;
use Doctrine\Persistence\ObjectManager;

class TimestampableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('timestampables.json', Timestampable::class);

        parent::load($manager);
    }
}
