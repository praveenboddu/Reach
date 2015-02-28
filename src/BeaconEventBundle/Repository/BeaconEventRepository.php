<?php

namespace BeaconEventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultExecption;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;

use BeaconEventBundle\Entity\BeaconEvent;

/**
*	BeaconEventRepository
*/
class BeaconEventRepository extends EntityRepository
{
	public function findEvents($clientId, $beaconlocales, $filter = array('perpage' => 25, 'page' => 1))
	{
		$em = $this->getEntityManager();

		$qb = $em->createQueryBuilder();

		$qb->select('b')
		   ->from('BeaconEventBundle:BeaconEvent', 'b')
		   ->where('b.clientId = :clientId')
		   ->andWhere('b.beaconLocaleId = :beaconLocale')
		   ->setParameter('clientId', $clientId)
		   ->setParameter('beaconLocale', $beaconlocales);

		if ($filter['page'] && $filter('perpage')) {
			$page = $filter['page'] ? $filter['page'] : 1;
			$perpage = $filter['perpage'] ? $filter['perpage'] : 20;
			$offset = (int)(($page-1)*$perpage);
			$perpage = (int)$perpage;
			$qb->setFirstResult($offset)
				->setMaxResults($perpage);
		}

		$orderBy = 'b.created';
		$qb->orderBy($orderBy, 'ASC');

		$query = $qb->getQuery();
		$paginator = $this->createPaginator($query, false);
		$totalResults = $paginator->count();

		$result = array($totalResults, $paginator->getIterator());
		return $result;
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