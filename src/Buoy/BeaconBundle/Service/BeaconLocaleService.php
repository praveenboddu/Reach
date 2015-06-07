<?php

namespace Buoy\BeaconBundle\Service;

use Doctrine\ORM\EntityManager;
use Buoy\BeaconBundle\Entity\BeaconLocale;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
//use Scout\Common\Service\Response as Response;

class BeaconService
{

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
    }

    public function create($data)
    {
        $beaconLocale = new BeaconLocale();
        $beaconLocale->setBeaconId($data['beaconId']);
        $beaconLocale->setClientId($data['clientId']);
        $beaconLocale->setLocaleId($data['localeId']);
        $beaconLocale->setActiveFrom($data['activeFrom']);
        if (isset($data['activeUntil'])) {
            $beaconLocale->setActiveUntil($data['activeUntil']);
        }

        $this->em->persist($beaconLocale);
        $this->em->flush();

        return new Response($beaconEntity->getId());
    }

    public function get($id)
    {
        $response = new Response;
        $event = $this->em->getRepository('BeaconBundle:Beacon')->find($id);
        return $response->setData($event->toArray());
    }

}