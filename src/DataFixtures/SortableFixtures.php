<?php

namespace App\DataFixtures;

use App\Entity\Sortable;
use Doctrine\Persistence\ObjectManager;

class SortableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('sortables.json', Sortable::class);

        parent::load($manager);
    }
}
