<?php

namespace App\DataFixtures;

use App\Entity\RCategory;
use App\Entity\RProduct;
use Doctrine\Persistence\ObjectManager;

class RProductsFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->setPath('r-products.json', RProduct::class);

        $categoryRepo = $manager->getRepository(RCategory::class);
        $productRepo = $manager->getRepository($this->className);

        $listData = $this->getListData();
        foreach ($listData as $data) {
            $category = $categoryRepo->findOneByName($data['categoryName']);
            $product = $this->serializerService->deserialize($data, $this->className);

            $product->setCategory($category);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
