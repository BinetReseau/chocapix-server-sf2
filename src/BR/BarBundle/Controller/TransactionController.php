<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Account\Account;
use BR\BarBundle\Entity\Operation\AccountOperation;
use BR\BarBundle\Entity\Stock\StockItem;
use BR\BarBundle\Entity\Operation\StockOperation;
use BR\BarBundle\Entity\Transaction\Transaction;
use BR\BarBundle\Entity\Transaction\BuyTransaction;

class TransactionController extends FOSRestController {
	/**
	 * @Get("/{bar}/transaction")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @QueryParam(name="limit", requirements="\d+", default="0")
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getTransactionsAction(Bar $bar, $limit) {
		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Transaction\Transaction')
				->createQueryBuilder('t')
				->where('t.bar = :bar')
				->orderBy('t.id', 'DESC')
				->setParameter('bar', $bar);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}

	/**
	 * @Get("/{bar}/transaction/by-item/{item}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @QueryParam(name="limit", requirements="\d+", default="0")
	 *
     * @View()
     */
	public function getTransactionByItemAction(Bar $bar, StockItem $item, $limit) {
		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Operation\StockOperation')
				->createQueryBuilder('o')
				->select('IDENTITY(o.transaction)')
				->where('o.item = :item');

		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Transaction\Transaction')
				->createQueryBuilder('t')
				->where('t.bar = :bar')
				->andWhere('t.id IN ('.$qb->getDQL().')')
				->orderBy('t.id', 'DESC')
				->setParameter('bar', $bar)
				->setParameter('item', $item);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}

	/**
	 * @Get("/{bar}/transaction/by-account/{account}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("account", class="BRBarBundle:Account\Account", options={"id" = "account"})
	 * @QueryParam(name="limit", requirements="\d+", default="0")
	 *
     * @View()
     */
	public function getTransactionByAccountAction(Bar $bar, Account $account, $limit) {
		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Operation\AccountOperation')
				->createQueryBuilder('o')
				->select('IDENTITY(o.transaction)')
				->where('o.account = :account');

		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Transaction\Transaction')
				->createQueryBuilder('t')
				->where('t.bar = :bar')
				->andWhere('t.id IN ('.$qb->getDQL().')')
				->orderBy('t.id', 'DESC')
				->setParameter('bar', $bar)
				->setParameter('account', $account);
		if($limit!=0)
			$qb->setMaxResults($limit);

		return $qb->getQuery()->getResult();
	}


	/**
	 * @Get("/{bar}/transaction/{transaction}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("transaction", class="BRBarBundle:Transaction\Transaction", options={"id" = "transaction"})
	 *
     * @View()
     */
	public function getTransactionAction(Bar $bar, Transaction $transaction) {
		return $transaction;
	}


	/**
	 * @Post("/{bar}/buy")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="item", requirements="\d+", strict=true)
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @RequestParam(name="qty", requirements="[0-9.]+", strict=true)
	 *
     * @Security("is_granted('ACCOUNT', bar)")
     *
     * @View()
     */
	public function buyAction(Bar $bar, StockItem $item, $qty) {
		$em = $this->getDoctrine()->getManager();

		$transaction = new BuyTransaction($bar);

		$item->operation($transaction, -$qty);

		$account = $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($this->getUser(), $bar);
		$account->operation($transaction, -$qty * $item->getPrice());

		$em->persist($transaction);
		$em->flush();

		return $transaction;
	}



	/**
	 * @Get("/{bar}/transaction/cancel/{transaction}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("transaction", class="BRBarBundle:Transaction\Transaction", options={"id" = "transaction"})
	 *
     * @View()
     */
	public function cancelTransactionAction(Bar $bar, Transaction $transaction) {
		$em = $this->getDoctrine()->getManager();

		$transaction->setCanceled(true);

		$repo = $em->getRepository('BRBarBundle:Operation\Operation');
		$repo->propagateModifiedOperation($transaction->getOperations()[0]);
		$repo->propagateModifiedOperation($transaction->getOperations()[1]);

		$em->flush();
	}
}
