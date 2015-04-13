<?php

namespace Buoy\LocaleBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultExecption;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Buoy\LocaleBundle\Entity\Locale;

/**
*	LocaleRepositoryRepository
*/
class LocaleRepository extends EntityRepository
{
	public function findLocales($clientId, $filter = array('perpage' => 25, 'page' => 1))
	{
		$em = $this->getEntityManager();

		$qb = $em->createQueryBuilder();

		$qb->select('l')
		   ->from('BuoyLocaleBundle:Locale', 'l')
		   ->where('l.clientId = :clientId')
		   ->setParameter('clientId', $clientId);

		if (isset($filter['latitude'])) {
			$qb->andWhere('(6371 * acos(cos(radians(' . $filter['latitude'] . ')) * cos(radians(l.latitude)) * cos(radians(l.longitude) - radians(' . $filter['longitude'] . ')) + sin(radians(' . $filter['latitude'] . ')) * sin(radians(l.latitude)))) < :distance')
                ->setParameter('distance', $filter['range']);
		}

		$page = $filter['page'] ? $filter['page'] : 1;
		$perpage = $filter['perpage'] ? $filter['perpage'] : 20;
		$offset = (int)(($page-1)*$perpage);
		$perpage = (int)$perpage;
		$qb->setFirstResult($offset)
			->setMaxResults($perpage);

		$orderBy = 'l.created';
		$qb->orderBy($orderBy, 'ASC');
		$query = $qb->getQuery();
		//$paginator = $this->createPaginator($query, false);
		//$totalResults = $paginator->count();

		//$result = array($totalResults, $paginator->getIterator());
		//var_dump($result);

		return $query->getResult();
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