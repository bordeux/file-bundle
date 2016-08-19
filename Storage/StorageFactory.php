<?php


namespace Bordeux\Bundle\FileBundle\Storage;

use Bordeux\Bundle\FileBundle\Entity\Storage;

interface StorageFactory
{

    /**
     * @param Storage $storage
     * @return StorageProvider
     * @author Krzysztof Bednarczyk
     */
    public function getProvider(Storage $storage);
}