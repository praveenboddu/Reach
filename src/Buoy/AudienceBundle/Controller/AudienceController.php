<?php

namespace Buoy\AudienceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class AudienceController extends FOSRestController implements ClassResourceInterface
{
    public function cgetAction(Request $request)
    {
    	return new Response('Collection Get');
    }
}
