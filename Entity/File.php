<?php

namespace Bordeux\Bundle\FileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="Bordeux\Bundle\FileBundle\Repository\FileRepository")
 */
class File
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=60)
     */
    private $mime;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime",  nullable=true)
     */
    private $expireDate;


    /**
     * @var string
     *
     * @ORM\Column(name="access_key", type="string", length=255)
     */
    private $accessKey;

    /**
     * @var []
     *
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;


    /**
     * @var FileMetaData
     * @ORM\ManyToOne(targetEntity="FileMetaData")
     * @ORM\JoinColumn(name="file_metadata_id", referencedColumnName="id")
     */
    private $metaData;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime",  nullable=false)
     */
    private $createDate;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delete_date", type="datetime",  nullable=true)
     */
    private $deleteDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean",  nullable=false)
     */
    private $deleted;


    /**
     * @author Krzysztof Bednarczyk
     * File constructor.
     */
    public function __construct()
    {
        $this->deleted = false;
        $this->createDate = new \DateTime();
    }


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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $mime
     * @return $this
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param \DateTime $expireDate
     * @return $this
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $accessKey
     * @return $this
     */
    public function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return []
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param [] $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }



    /**
     * @author Krzysztof Bednarczyk
     * @return FileMetaData
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param FileMetaData $metaData
     * @return $this
     */
    public function setMetaData(FileMetaData $metaData)
    {
        $this->metaData = $metaData;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }


    /**
     * @author Krzysztof Bednarczyk
     * @return \DateTime
     */
    public function getDeleteDate()
    {
        return $this->deleteDate;
    }


    /**
     * @author Krzysztof Bednarczyk
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param boolean $deleted
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->deleteDate = $deleted  ? new \DateTime() : null;
        $this->deleted = $deleted;
        return $this;
    }





}

