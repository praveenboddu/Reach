<?php

namespace BeaconBundle\Service;

use Doctrine\ORM\EntityManager;
use BeaconBundle\Entity\Beacon;
//use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Scout\Common\Service\Response as Response;

class BeaconService
{

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
    }

    public function create($data)
    {
        $beaconEntity = new Beacon();
        $beaconEntity->setBeaconId($data['beaconId']);
        $beaconEntity->setClientId($data['clientId']);

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