<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;

use BR\BarBundle\Entity\Operation\Transaction;
use BR\BarBundle\Entity\Stock\StockOperation;
use BR\BarBundle\Entity\Account\AccountOperation;

class TransactionController extends FOSRestController {

	/**
	 * @Get("/{bar}/transaction")
     * @View(serializerGroups={"Default"})
     */
	public function getTransactionsAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Operation\Transaction');

		$transactions = $repository->createQueryBuilder('t')
		  //       ->where('t.bar = :bar')
				// ->setParameter('bar', $bar)
				->orderBy('t.timestamp', 'DESC')
				->getQuery()->getResult();

		return $transactions;
	}

	/**
	 * @Get("/{bar}/transaction/{id}")
     * @View(serializerGroups={"Default"})
     */
	public function getTransactionAction(Request $request, $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Operation\Transaction');

		$transactions = $repository->createQueryBuilder('t')
		        ->where('t.id = :id')
		        ->andWhere('t.bar = :bar')
				->orderBy('t.timestamp', 'DESC')
				->setParameter('id', $id)
				->setParameter('bar', $bar)
				->getQuery()->getResult();

		return $transactions;
	}


	/**
	 * @Get("/{bar}/buy/{iid}/{aid}/{qty}")
     * @View(serializerGroups={"Default"})
     */
	public function buyAction(Request $request, $bar, $iid, $aid, $qty) {
		$em = $this->getDoctrine()->getManager();

		$transaction = new Transaction("buy");

		$item = $em->getRepository('BRBarBundle:Stock\StockItem')
					->find($iid);
		$operation1 = new StockOperation($transaction, $item, -$qty);
		$transaction->addOperation($operation1);

		$account = $em->getRepository('BRBarBundle:Account\Account')
					->find($aid);
		$operation2 = new AccountOperation($transaction, $account, -$qty * $item->getPrice());
		$transaction->addOperation($operation2);

		$em->persist($operation1);
		$em->persist($operation2);
		$em->persist($transaction);
		$em->flush();

		return $transaction;
	}

}
