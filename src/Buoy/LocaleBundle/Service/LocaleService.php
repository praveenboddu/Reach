<?php

namespace Buoy\LocaleBundle\Service;

use Doctrine\ORM\EntityManager;
use Buoy\LocaleBundle\Entity\Locale;
use Symfony\Component\HttpFoundation\JsonResponse as Response;

class LocaleService
{

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
    }

    public function create($data, $address)
    {
        $response = new Response;
        if (count($address) > 1) {
            $response->setStatusCode(400);
            $response->setContent('Given address return more than 1 result, verify the address');
            return $response;
        }
        $locale = $this->setLocale($data, $address[0], $data['clientId']);
        if (!$locale instanceof Locale) {
            $response->setStatusCode(400);
            $response->setContent('Bad Request');
            return $response;

        }
        $result = $this->save($locale);
        if (!$result instanceof $locale) {
            $response->setStatusCode(400);
            $response->setContent('conflict');
            return $response;
        }
        return $response->setData($locale->getId());
    }

    private function setLocale($data, $address, $clientId)
    {
        $localeEntity = new Locale();
        $localeEntity->setName($data['name'])
                    ->setClientId($clientId)
                    ->setIsActive(true)
                    ->setStreetNumber($address['streetNumber'])
                    ->setStreetName($address['streetName'])
                    ->setCity($address['city'])
                    ->setState($address['region'])
                    ->setCountry($address['country'])
                    ->setZipcode($address['zipcode'])
                    ->setLatitude($address['latitude'])
                    ->setLongitude($address['longitude']);

        return $localeEntity;
    }

    private function save(Locale $locale)
    {
        try {
            $this->em->persist($locale);
            $this->em->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $locale;
    }

    public function get($id)
    {
        $response = new Response;
        $locale = $this->em->getRepository('BuoyLocaleBundle:Locale')->find($id);
        if (!$locale instanceof Locale) {
            return $response->setStatusCode(404);
        }
        return $response->setData($locale->toArray());
    }

    public function getCollection($data, $clientId)
    {
        $filter = array();
        $filter['perpage'] = 25;
        $filter['page'] = 1;
        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $filter['range'] = isset($data['range']) ? $data['range'] : 50;
            $filter['latitude'] = $data['latitude'];
            $filter['longitude'] = $data['longitude'];
        }
        
        $locales = $this->em->getRepository('BuoyLocaleBundle:Locale')->findLocales($clientId, $filter);
        return $locales;    
    }

}