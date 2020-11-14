<?php

namespace App\DataFixtures;

use App\Entity\Loggable;
use Doctrine\Persistence\ObjectManager;

class LoggableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('loggables.json', Loggable::class);

        parent::load($manager);
    }
}
