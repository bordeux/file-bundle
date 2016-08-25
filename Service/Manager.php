<?php

namespace Bordeux\Bundle\FileBundle;

use Bordeux\Bundle\FileBundle\Entity\File;
use Bordeux\Bundle\FileBundle\Entity\FileMetaData;
use Bordeux\Bundle\FileBundle\Entity\Storage;
use Bordeux\Bundle\FileBundle\Storage\StorageFactory;
use Bordeux\Bundle\FileBundle\Storage\StorageProvider;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Manager
{
    use ContainerAwareTrait;

    /**
     * @var StorageProvider
     */
    protected $storage = [];


    /**
     * @param File $file
     * @return resource
     * @author Krzysztof Bednarczyk
     */
    public function getResource(File $file)
    {
        return $this->getResourceFromMetaData(
            $file->getMetaData()
        );
    }

    /**
     * @param FileMetaData $fileMetaData
     * @return resource
     * @author Krzysztof Bednarczyk
     */
    public function getResourceFromMetaData(FileMetaData $fileMetaData)
    {
        return $this->getStorageProvider(
            $fileMetaData->getStorage()
        )->fetch($fileMetaData->getId());

    }


    /**
     * @param File $file
     * @return string
     * @author Krzysztof Bednarczyk
     */
    public function getTemporaryPath(File $file)
    {
        return $this->getTemporaryPathFromMetaData(
            $file->getMetaData()
        );
    }


    /**
     * @param FileMetaData $fileMetaData
     * @return string
     * @author Krzysztof Bednarczyk
     */
    public function getTemporaryPathFromMetaData(FileMetaData $fileMetaData)
    {

        return '';
    }



    /**
     * @param Storage $storage
     * @return StorageProvider
     * @author Krzysztof Bednarczyk
     */
    public function getStorageProvider(Storage $storage)
    {
        if (isset($this->storage[$storage->getId()])) {
            return $this->storage[$storage->getId()];
        }

        if (!$this->container->has($storage->getServiceName())) {
            //@todo throw exception
        }

        $factory = $this->container->get($storage->getServiceName());
        if (!($factory instanceof StorageFactory)) {
            //@todo throw exception
        }

        $provider = $factory->getProvider($storage);
        $this->storage[$storage->getId()] = $provider;

        return $provider;
    }
}