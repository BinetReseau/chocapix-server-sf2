<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
	public function findAllFromBar($bar)
	{
		return $this->createQueryBuilder('a')
				->where('a.bar = :bar')
				->setParameter('bar', $bar)
				->getQuery()->getResult();
	}

	public function findAllFromUser($user)
	{
		return $this->createQueryBuilder('a')
				->where('a.user = :user')
				->setParameter('user', $user)
				->getQuery()->getResult();
	}

	public function findFromUserAndBar($user, $bar)
	{
		return $this->createQueryBuilder('a')
				->where('a.bar = :bar')
				->andWhere('a.user = :user')
				->setParameter('bar', $bar)
				->setParameter('user', $user)
				->getQuery()->getOneOrNullResult();
	}
}
