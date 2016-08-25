<?php

namespace Bordeux\Bundle\FileBundle\Storage;

/**
 * Interface Storage
 * @package Bordeux\Bundle\FileBundle\Storage
 * @author Krzysztof Bednarczyk
 */
interface Storage
{

    /**
     * @param int $id
     * @param resource $resource
     * @return bool
     * @author Krzysztof Bednarczyk
     */
    public function put(int $id, resource $resource) : bool ;


    /**
     * @param int $id
     * @return resource
     * @author Krzysztof Bednarczyk
     */
    public function fetch(int $id) : resource;

    /**
     * @param int $id
     * @return bool
     * @author Krzysztof Bednarczyk
     */
    public function remove(int $id) : bool;


    /**
     * @param int $id
     * @return boolean
     * @author Krzysztof Bednarczyk
     */
    public function exist(int $id) : bool;
}