<?php

namespace Bordeux\Bundle\FileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StorageParameter
 *
 * @ORM\Table(name="file__storage_parameter")
 * @ORM\Entity(repositoryClass="Bordeux\Bundle\FileBundle\Repository\StorageParameterRepository")
 */
class StorageParameter
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
     * @ORM\ManyToOne(targetEntity="Storage", inversedBy="parameters")
     * @ORM\JoinColumn(name="storage_id", referencedColumnName="id")
     */
    private $storage;


    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=255)
     */
    private $key;


    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * @author Krzysztof Bednarczyk
     * StorageParameter constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct($key = null, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
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
     * @return mixed
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param mixed $storage
     * @return $this
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }




}

