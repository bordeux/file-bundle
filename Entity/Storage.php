<?php

namespace Bordeux\Bundle\FileBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Storage
 *
 * @ORM\Table(name="file__storage")
 * @ORM\Entity(repositoryClass="Bordeux\Bundle\FileBundle\Repository\StorageRepository")
 */
class Storage
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
     * @ORM\Column(name="service_name", type="string", length=255)
     */
    private $serviceName;


    /**
     * @var StorageParameter[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="StorageParameter", mappedBy="storage")
     */
    private $parameters;

    /**
     * @author Krzysztof Bednarczyk
     * Storage constructor.
     */
    public function __construct()
    {
        $this->parameters = new ArrayCollection();
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
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param string $serviceName
     * @return $this
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
        return $this;
    }


    /**
     * @author Krzysztof Bednarczyk
     * @return StorageParameter[]|ArrayCollection
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param StorageParameter[]|ArrayCollection $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }


}

