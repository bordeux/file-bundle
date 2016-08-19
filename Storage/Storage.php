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
     * @param string $bucket
     * @param string $id
     * @param resource $resource
     * @return boolean
     * @author Krzysztof Bednarczyk
     */
    public function put($bucket, $id, $resource);


    /**
     * @param string $bucket
     * @param string $id
     * @return resource
     * @author Krzysztof Bednarczyk
     */
    public function fetch($bucket, $id);

    /**
     * @param string $bucket
     * @param string $id
     * @return mixed
     * @author Krzysztof Bednarczyk
     */
    public function remove($bucket, $id);


    /**
     * @param string $bucket
     * @param string $id
     * @return boolean
     * @author Krzysztof Bednarczyk
     */
    public function exist($bucket, $id);
}