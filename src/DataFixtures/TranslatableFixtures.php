<?php

namespace App\DataFixtures;

use App\Entity\Translatable;
use Doctrine\Persistence\ObjectManager;

class TranslatableFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('translatables.json', Translatable::class);

        parent::load($manager);

        $repository = $manager->getRepository(Translatable::class);

        $translatables = $repository->findAll();
        foreach ($translatables as $translatable) {
            $translatable->setTitle('Tiêu đề ' . $translatable->getId());
            $translatable->setContent('Nội dung ' . $translatable->getId());
            $translatable->setTranslatableLocale('vi_vn');

            $manager->persist($translatable);
        }

        $manager->flush();
    }
}
