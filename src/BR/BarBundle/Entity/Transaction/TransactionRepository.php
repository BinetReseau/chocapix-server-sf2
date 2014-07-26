<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\EntityRepository;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Account\Account;
use BR\BarBundle\Entity\Stock\StockItem;
use BR\BarBundle\Entity\Transaction\Transaction;

class TransactionRepository extends EntityRepository
{
	public function getTransactionsByIdAndBar($id, Bar $bar, $limit = 0) {
		$qb = $this->createQueryBuilder('t')
				->select('t, author, author_account')
				->where('t.id = :id')
				->innerjoin('t.author', 'author')
				->leftjoin('author.accounts', 'author_account', 'WITH', 'author_account.bar = :bar')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('id', $id)
				->setParameter('bar', $bar);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}

	public function getTransactionsByBar(Bar $bar, $limit = 0) {
		$qb = $this->createQueryBuilder('t')
				->select('t, author, author_account')
				->where('t.bar = :bar')
				->innerjoin('t.author', 'author')
				->leftjoin('author.accounts', 'author_account', 'WITH', 'author_account.bar = :bar')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('bar', $bar);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}

	public function getTransactionsByBarAndItem(Bar $bar, StockItem $item, $limit = 0) {
		$em = $this->getEntityManager();

		$qb = $em->getRepository('BRBarBundle:Operation\StockOperation')
				->createQueryBuilder('o')
				->select('IDENTITY(o.transaction)')
				->where('o.item = :item');

		$qb = $this->createQueryBuilder('t')
				->select('t, author, author_account')
				->where('t.bar = :bar')
				->innerjoin('t.author', 'author')
				->leftjoin('author.accounts', 'author_account', 'WITH', 'author_account.bar = :bar')
				->andWhere('t.id IN ('.$qb->getDQL().')')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('bar', $bar)
				->setParameter('item', $item);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}

	public function getTransactionsByBarAndAccount(Bar $bar, Account $account, $limit = 0) {
		$em = $this->getEntityManager();

		$qb = $em->getRepository('BRBarBundle:Operation\AccountOperation')
				->createQueryBuilder('o')
				->select('IDENTITY(o.transaction)')
				->where('o.account = :account');

		$qb = $this->createQueryBuilder('t')
				->select('t, author, author_account')
				->where('t.bar = :bar')
				->innerjoin('t.author', 'author')
				->leftjoin('author.accounts', 'author_account', 'WITH', 'author_account.bar = :bar')
				->andWhere('t.id IN ('.$qb->getDQL().') OR t.author = :user')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('bar', $bar)
				->setParameter('user', $account->getUser())
				->setParameter('account', $account);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}


	public function propagateTransactionModification(Transaction $transaction) {
		$em = $this->getEntityManager();

		$repo = $em->getRepository('BRBarBundle:Operation\Operation');
		foreach ($transaction->getOperations() as $op) {
			$repo->propagateModifiedOperation($op);
		}
	}
}
