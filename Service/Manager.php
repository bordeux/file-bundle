<?php

namespace Bordeux\Bundle\FileBundle;

use Bordeux\Bundle\FileBundle\Entity\File;
use Bordeux\Bundle\FileBundle\Entity\FileMetaData;
use Bordeux\Bundle\FileBundle\Entity\Storage;
use Bordeux\Bundle\FileBundle\Storage\StorageFactory;
use Bordeux\Bundle\FileBundle\Storage\StorageProvider;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class Manager
 * @package Bordeux\Bundle\FileBundle
 * @author Krzysztof Bednarczyk
 */
class Manager
{
    use ContainerAwareTrait;

    /**
     * @var StorageProvider
     */
    protected $storage = [];

    /**
     * @var string
     */
    protected $temporaryDir;

    /**
     * @var string[]
     */
    protected $temporaryFiles = [];

    /**
     * @author Krzysztof Bednarczyk
     * Manager constructor.
     * @param string $temporaryDir
     */
    public function __construct($temporaryDir)
    {
        $this->temporaryDir = $temporaryDir ?: sys_get_temp_dir();
    }


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
    public function getResourceFromMetaData(FileMetaData $fileMetaData) : \resource
    {
        return $this->getStorageProvider(
            $fileMetaData->getStorage()
        )->fetch($fileMetaData->getId());
    }


    /**
     * @param resource $resource
     * @param $filename
     * @return File
     * @author Krzysztof Bednarczyk
     */
    public function setResource(\resource $resource, string $filename) : File
    {
        $temporaryFile = $this->getTemporaryFilePath();
        file_put_contents($temporaryFile, $resource);
        return $this->setResourceFromPath($temporaryFile, $filename);
    }


    /**
     * @param string $path
     * @param string $filename
     * @return File
     * @author Krzysztof Bednarczyk
     */
    public function setResourceFromPath(string $path, string $filename) : File
    {
        $data = [];
        $file = new File();
        $file->setName($filename);
        $file->setMime(
            finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path)
        );
        $file->setAccessKey(
            md5(rand() . uniqid('', true) . rand() . uniqid() . time())
        );
        $file->setData($data);
        $file->setMetaData(
            $this->getFileMetadata($path)
        );
        return $file;
    }


    /**
     * @param File $file
     * @return string
     * @author Krzysztof Bednarczyk
     */
    public function getTemporaryPath(File $file) : string
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
    public function getTemporaryPathFromMetaData(FileMetaData $fileMetaData) : string
    {
        $file = $this->getTemporaryFilePath();
        $resource = $this->getResourceFromMetaData($fileMetaData);
        file_put_contents($file, $resource); //@todo check and exception
        return $file;
    }

    /**
     * @return string
     * @author Krzysztof Bednarczyk
     */
    private function getTemporaryFilePath() : string
    {
        $file = tempnam($this->temporaryDir, 'file__');

        $this->temporaryDir[] = $file;
        return $file;
    }


    /**
     * @param Storage $storage
     * @return StorageProvider
     * @author Krzysztof Bednarczyk
     */
    public function getStorageProvider(Storage $storage) : StorageProvider
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


    /**
     * @param string $path
     * @return FileMetaData
     * @author Krzysztof Bednarczyk
     */
    protected function getFileMetadata(string $path) : FileMetaData
    {
        $fileMetaData = new FileMetaData($path);
        $fileMetaData->setMd5(
            hash_file('md5', $path)
        );
        $fileMetaData->setSha(
            hash_file('sha1', $path)
        );
        $fileMetaData->setCrc32(
            hash_file('crc32', $path)
        );
        $fileMetaData->setSize(filesize($path));

        return $this->container
            ->get("doctrine")
            ->getRepository("BordeuxFileBundle:FileMetaData")
            ->findOneBy([
                "md5" => $fileMetaData->getMd5(),
                "sha" => $fileMetaData->getSha(),
                "crc32" => $fileMetaData->getCrc32(),
                "size" => $fileMetaData->getSize(),
            ]) ?: $fileMetaData;
    }


    /**
     * Remove created files
     */
    function __destruct()
    {
        register_shutdown_function(function ($files) {
            foreach ($files as $file) {
                @unlink($file);
            }
        }, $this->temporaryFiles);

    }


}