<?php

namespace Buoy\LocaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as Response;

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
        $data = $request->query->all();

        $localeService = $this->container->get('locale.service');
        $locales = $localeService->getCollection($data, $data['clientId']);
        return new Response($this->container->get('jms_serializer')->serialize($locales, 'json'), 200, array('totalCount' => count($locales)));
    }

    public function postAction(Request $request)
    {
        $postData = $request->request->all();   
        $geocoder = $this->get('geocoder.address');
        $address = $geocoder->getGeocodedData($postData['address']);
    	$localeService = $this->container->get('locale.service');
    	return $localeService->create($postData, array($address[0]));
    }
}
