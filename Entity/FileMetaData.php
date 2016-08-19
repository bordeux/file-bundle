<?php

namespace Bordeux\Bundle\FileBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FileMetaData
 *
 * @ORM\Table(name="file__meta_data")
 * @ORM\Entity(repositoryClass="Bordeux\Bundle\FileBundle\Repository\FileMetaDataRepository")
 */
class FileMetaData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var File[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="File", mappedBy="metaData")
     */
    private $files;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="sha", type="string", length=255, nullable=false)
     */
    private $sha;

    /**
     * @var string
     *
     * @ORM\Column(name="md5", type="string", length=32, nullable=false)
     */
    private $md5;


    /**
     * @var Storage
     * @ORM\ManyToOne(targetEntity="Bordeux\Bundle\FileBundle\Entity\Storage")
     * @ORM\JoinColumn(name="storage_id", referencedColumnName="id", nullable=false)
     */
    private $storage;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return File[]|ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param int $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $sha
     * @return $this
     */
    public function setSha($sha)
    {
        $this->sha = $sha;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $md5
     * @return $this
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return Storage
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param Storage $storage
     * @return $this
     */
    public function setStorage(Storage $storage)
    {
        $this->storage = $storage;
        return $this;
    }



}

