<?php

namespace BeaconEventBundle\Service;

use Doctrine\ORM\EntityManager;
use BeaconEventBundle\Entity\BeaconEvent;
use Symfony\Component\HttpFoundation\Response;

class BeaconEventService
{

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
    }

    public function create($data)
    {
        $event = new BeaconEvent();
        $event->setBeaconId($data['id']);
        $event->setEmail(hash('md5', $data['email']));
        $event->setClientId($data['clientId']);

        $this->em->persist($event);
        $this->em->flush();

        return new Response($event->getId());
    }

    public function get($id)
    {

        $event = $this->em->getRepository('BeaconEventBundle:BeaconEvent')->find($id);

        return new Response($event);
    }

}