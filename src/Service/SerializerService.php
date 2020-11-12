<?php

namespace App\Service;

use App\Helper\Arr;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SerializerService
 *
 * @package App\Service
 */
class SerializerService
{
    /**
     * SerializerService constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Serialize a collection of objects to an array.
     *
     * @param  array $data
     * @return array
     */
    public function serialize($data, $mapKey = true, $key = 'id')
    {
        $result = $this->serializer->serialize($data, 'json');
        $result = json_decode($result, true);

        if ($mapKey) {
            return Arr::mapKey($result, $key);
        }

        return $result;
    }

    /**
     * Deserialize an array to a entity.
     *
     * @param  array $data
     * @return entity
     */
    public function deserialize($data, $className)
    {
        $jsonData = json_encode($data);
        $entity = $this->serializer->deserialize($jsonData, $className, 'json');

        return $entity;
    }
}
