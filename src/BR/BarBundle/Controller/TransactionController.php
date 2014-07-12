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
use BR\BarBundle\Entity\Operation\Transaction;
use BR\BarBundle\Entity\Account\Account;
use BR\BarBundle\Entity\Account\AccountOperation;
use BR\BarBundle\Entity\Stock\StockItem;
use BR\BarBundle\Entity\Stock\StockOperation;

class TransactionController extends FOSRestController {

	/**
	 * @Get("/{bar}/transaction")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @QueryParam(name="limit", requirements="\d+", default="30")
     * @View(serializerGroups={"Default"})
     */
	public function getTransactionsAction(Bar $bar, $limit) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Operation\Transaction');

		$transactions = $repository->createQueryBuilder('t')
				->where('t.bar = :bar')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('bar', $bar->getId())
				->setMaxResults($limit)
				->getQuery()->getResult();

		return $transactions;
	}

	/**
	 * @Get("/{bar}/transaction/{id}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @View(serializerGroups={"Default"})
     */
	public function getTransactionAction(Bar $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Operation\Transaction');

		$transactions = $repository->createQueryBuilder('t')
		        ->where('t.id = :id')
		        ->andWhere('t.bar = :bar')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('id', $id)
				->setParameter('bar', $bar->getId())
				->getQuery()->getResult();

		return $transactions;
	}

	/**
	 * @Get("/{bar}/transaction/by-item/{item}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 *
     * @View(serializerGroups={"Default"})
     */
	public function getTransactionByItemAction(Bar $bar, StockItem $item) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockOperation');

		$transactions = $repository->createQueryBuilder('so')
				->select('IDENTITY(so.transaction) as id')
				->where('so.item = :item')
				->setParameter('item', $item->getId())
				->getQuery()->getResult();

		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Operation\Transaction');

		$transactions = array_map(function($d){return $d['id'];}, $transactions);
		$transactions = $repository->findById($transactions);

		return $transactions;
	}

	/**
	 * @Get("/{bar}/transaction/by-account/{account}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("account", class="BRBarBundle:Account\Account", options={"id" = "account"})
	 *
     * @View(serializerGroups={"Default"})
     */
	public function getTransactionByAccountAction(Bar $bar, Account $account) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Account\AccountOperation');

		$transactions = $repository->createQueryBuilder('ao')
				->select('IDENTITY(ao.transaction) as id')
				->where('ao.account = :account')
				->setParameter('account', $account->getId())
				->getQuery()->getResult();

		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Operation\Transaction');

		$transactions = array_map(function($d){return $d['id'];}, $transactions);
		$transactions = $repository->findById($transactions);

		return $transactions;
	}


	/**
     * @Security("has_role('ROLE_USER')")
     *
	 * @Post("/{bar}/buy")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="item", requirements="\d+", strict=true)
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @RequestParam(name="qty", requirements="[0-9.]+", strict=true)
	 *
     * @View(serializerGroups={"Default"})
     */
	public function buyAction(Bar $bar, StockItem $item, $qty) {
		$em = $this->getDoctrine()->getManager();

		$transaction = new Transaction($bar, "buy");

		$operation1 = $item->operation($transaction, -$qty);

		$account = $this->getUser()->getAccount();
		$operation2 = $account->operation($transaction, -$qty * $item->getPrice());

		$em->persist($operation1);
		$em->persist($operation2);
		$em->persist($transaction);
		$em->flush();

		return $transaction;
	}
}
