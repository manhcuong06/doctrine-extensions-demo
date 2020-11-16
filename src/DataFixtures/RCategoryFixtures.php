<?php

namespace App\DataFixtures;

use App\Entity\RCategory;
use Doctrine\Persistence\ObjectManager;

class RCategoryFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('r-categories.json', RCategory::class);

        parent::load($manager);
    }
}
