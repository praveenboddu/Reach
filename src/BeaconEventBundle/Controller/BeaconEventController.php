<?php

namespace BeaconEventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Response;

/**
*  @RouteResource("beaconEvents")
*/
class BeaconEventController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id)
    {
    	$beaconEventService = $this->container->get('beacon_event');
    	return $beaconEventService->get($id);
    }

    public function cgetAction(Request $request)
    {
    	return new Response('Hello');
    }

    public function postAction(Request $request)
    {
    	$postData = $request->request->all();

    	$beaconEventService = $this->container->get('beacon_event');
    	return $beaconEventService->create($postData);
    }
}