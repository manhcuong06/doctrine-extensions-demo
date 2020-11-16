<?php

namespace App\Event;

class CircularReferenceHandler
{
    public function __invoke($object)
    {
        return '---' . $object->getId() . '---';
    }
}
