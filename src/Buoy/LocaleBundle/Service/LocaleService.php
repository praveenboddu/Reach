<?php

namespace Buoy\LocaleBundle\Service;

use Doctrine\ORM\EntityManager;
use Buoy\LocaleBundle\Entity\Locale;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
//use Scout\Common\Service\Response as Response;

class LocaleService
{

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
    }

    public function create($data)
    {
        $localeEntity = new Locale();
        $localeEntity->setName($data['name']);
        $localeEntity->setLocation($data['location']);
        $localeEntity->setClientId($data['clientId']);

        $this->em->persist($localeEntity);
        $this->em->flush();

        return new Response($localeEntity->getId());
    }

    public function get($id)
    {
        $response = new Response;
        $locale = $this->em->getRepository('BuoyLocaleBundle:Locale')->find($id);
        if (!$locale instanceof Locale) {
            return $response->setStatusCode(404);
        }
        return $response->setData($event->toArray());
    }

}