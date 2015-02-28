<?php

namespace BeaconBundle\Service;

use Doctrine\ORM\EntityManager;
use BeaconBundle\Entity\Locale;
//use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Scout\Common\Service\Response as Response;

class LocaleService
{

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
    }

    public function create($data)
    {
        $localeEntity = new Beacon();
        $localeEntity->setName($data['name']);
        $localeEntity->setLocation($data['location']);
        $localeEntity->setClientId($data['clientId']);

        $this->em->persist($beaconEntity);
        $this->em->flush();

        return new Response($beaconEntity->getId());
    }

    public function get($id)
    {
        $response = new Response;
        $event = $this->em->getRepository('BeaconBundle:Beacon')->find($id);
        return $response->setData($event);
    }

}