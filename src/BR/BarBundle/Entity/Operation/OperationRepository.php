<?php
namespace BR\BarBundle\Entity\Operation;

use Doctrine\ORM\EntityRepository;

class OperationRepository extends EntityRepository
{
	public function propagateModifiedOperation(Operation $op) {
		if($op instanceof AccountOperation)
			$this->propagateModifiedAccountOperation($op);
		elseif($op instanceof StockOperation)
			$this->propagateModifiedStockOperation($op);
	}

	protected function propagateModifiedAccountOperation(AccountOperation $ao) {
		$em = $this->getEntityManager();

		$nextops = $em->getRepository('BRBarBundle:Operation\AccountOperation')
				->createQueryBuilder('o')
				->leftjoin('o.transaction', 't')
				->where('o.account = :account')
				->andWhere('t.id >= :id')
				->orderBy('t.id', 'ASC')
				->setParameter('account', $ao->getAccount())
				->setParameter('id', $ao->getTransaction()->getId())
				->getQuery()->getResult();

		$money = $ao->getOldmoney();
		foreach ($nextops as $no) {
			$no->setOldmoney($money);
			if(!$no->getTransaction()->isCanceled())
				$money += $no->getDeltamoney();
		}
		$ao->getAccount()->setMoney($money);

		$em->flush();
	}

	protected function propagateModifiedStockOperation(StockOperation $so) {
		$em = $this->getEntityManager();

		$nextops = $em->getRepository('BRBarBundle:Operation\StockOperation')
				->createQueryBuilder('o')
				->leftjoin('o.transaction', 't')
				->where('o.item = :item')
				->andWhere('t.id >= :id')
				->orderBy('t.id', 'ASC')
				->setParameter('item', $so->getItem())
				->setParameter('id', $so->getTransaction()->getId())
				->getQuery()->getResult();

		$qty = $so->getOldqty();
		foreach ($nextops as $no) {
			$no->setOldqty($qty);
			if(!$no->getTransaction()->isCanceled())
				$qty += $no->getDeltaqty();
		}
		$so->getItem()->setQty($qty);

		$em->flush();
	}
}
