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
    private $fileService;

    /**
     * @var SerializerService
     */
    private $serializerService;

    private $fileName;

    private $className;

    public function __construct(FileService $fileService, SerializerService $serializerService)
    {
        $this->fileService = $fileService;
        $this->serializerService = $serializerService;
    }

    public function load(ObjectManager $manager)
    {
        $listData = $this->fileService->getFileContent(__DIR__ . '/Json', $this->fileName);
        foreach ($listData as $data) {
            $entity = $this->serializerService->deserialize($data, $this->className);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    protected function setPath($fileName, $className)
    {
        $this->fileName = $fileName;
        $this->className = $className;
    }
}
