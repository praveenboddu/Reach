<?php

namespace BeaconBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class BeaconController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id)
    {
    	$beaconService = $this->container->get('beacon.service');
    	return $beaconService->get($id);
    }

    public function cgetAction(Request $request)
    {
    	return new Response('Collection Get');
    }

    public function postAction(Request $request)
    {
    	$postData = $request->request->all();

    	$beaconService = $this->container->get('beacon.service');
    	return $beaconService->create($postData);
    }
}
