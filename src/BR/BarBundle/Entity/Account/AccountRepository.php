<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
	public function findFromBar($bar)
	{
		return $this->createQueryBuilder('a')
				->select('a, u')
				->innerjoin('a.user', 'u')
				->where('a.bar = :bar')
				->setParameter('bar', $bar)
				->getQuery()->getResult();
	}

	public function findFromUserAndBar($user, $bar)
	{
		return $this->createQueryBuilder('a')
				->select('a, u')
				->innerjoin('a.user', 'u')
				->where('a.bar = :bar')
				->andWhere('a.user = :user')
				->setParameter('bar', $bar)
				->setParameter('user', $user)
				->getQuery()->getOneOrNullResult();
	}
}
