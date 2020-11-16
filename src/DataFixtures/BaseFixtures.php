<?php

namespace App\DataFixtures;

use App\Service\FileService;
use App\Service\SerializerService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class BaseFixtures extends Fixture
{
    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * @var SerializerService
     */
    protected $serializerService;

    protected $fileName;

    protected $className;

    public function __construct(FileService $fileService, SerializerService $serializerService)
    {
        $this->fileService = $fileService;
        $this->serializerService = $serializerService;
    }

    public function load(ObjectManager $manager)
    {
        $listData = $this->getListData();
        foreach ($listData as $data) {
            $entity = $this->serializerService->deserialize($data, $this->className);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    protected function getListData()
    {
        return $this->fileService->getFileContent(__DIR__ . '/Json', $this->fileName);
    }

    protected function setPath($fileName, $className)
    {
        $this->fileName = $fileName;
        $this->className = $className;
    }
}
