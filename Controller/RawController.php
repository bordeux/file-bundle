<?php

namespace Bordeux\Bundle\FileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RawController
 * @package Bordeux\Bundle\FileBundle\Controller
 * @author Krzysztof Bednarczyk
 */
class RawController extends Controller
{
    /**
     * @Route("/raw/{version}/{fileId}/{accessKey}/")
     */
    public function indexAction(Request $request)
    {
        $response = new BinaryFileResponse('');


        return $response;
    }


}
