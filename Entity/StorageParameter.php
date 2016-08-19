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


}

