<?php

namespace Buoy\LocaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class LocaleController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id)
    {
    	$localeService = $this->container->get('locale.service');
    	return $localeService->get($id);
    }

    public function cgetAction(Request $request)
    {
    	return new Response('Collection Get');
    }

    public function postAction(Request $request)
    {
    	var_dump('im here');
        die;
        $postData = $request->request->all();

        $result = $this->container
            ->get('bazinga_geocoder.geocoder')
            ->using('google_maps')
            ->geocode($postData['address']);

        var_dump($result);
        die;

    	$localeService = $this->container->get('locale.service');
    	return $localeService->create($postData);
    }
}
