<?php

namespace Buoy\BeaconLocaleBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultExecption;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Buoy\BeaconLocaleBundle\Entity\Locale;

/**
*	BeaconLocaleRepositoryRepository
*/
class BeaconLocaleRepository extends EntityRepository
{
	public function findActiveBeaconLocale($clientId, $beaconId)
	{
		$em = $this->getEntityManager();

		$qb = $em->createQueryBuilder();

		$qb->select('bl')
		   ->from('BuoyBeaconLocaleBundle:BeaconLocale', 'bl')
		   ->innerJoin('bl.beacon', 'b')
		   ->where('bl.clientId = :clientId')
		   ->andWhere('b.id = :beaconId')
		   ->andWhere('bl.activeUntil >= :currentTime')
		   ->setParameter('clientId', $clientId)
		   ->setParameter('beaconId', $beaconId)
		   ->setParameter('currentTime', new DateTime);

		$query = $qb->getQuery();

		return $query->getOneOrNullResult();
	}

	public function save($beaconEvent)
	{
		$em = $this->getEntityManager();

		$em->persist($beaconEvent);
		try {
			$em->flush();
		} catch (\Exception $e) {
			return false;
		}

		return $beaconEvent->getId();
	}


	public function createPaginator($query, $value)
	{
		return new Paginator($query, $value);
	}
}