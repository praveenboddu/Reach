<?php

namespace BeaconBundle\Service;

use Doctrine\ORM\EntityManager;
use BeaconBundle\Entity\Locale;
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
        $event = $this->em->getRepository('BeaconBundle:Locale')->find($id);
        return $response->setData($event->toArray());
    }

}