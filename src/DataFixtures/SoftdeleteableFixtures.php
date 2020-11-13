<?php

namespace App\DataFixtures;

use App\Entity\Softdeleteable;
use Doctrine\Persistence\ObjectManager;

class SoftdeleteableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('softdeleteables.json', Softdeleteable::class);

        parent::load($manager);
    }
}
