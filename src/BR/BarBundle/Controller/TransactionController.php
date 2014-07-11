<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;

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
     * @Security("has_role('ROLE_USER')")
     *
	 * @Post("/{bar}/buy")
	 * @RequestParam(name="item", requirements="\d+", strict=true)
	 * @RequestParam(name="qty", requirements="[0-9.]+", strict=true)
	 *
     * @View(serializerGroups={"Default"})
     */
	public function buyAction(Request $request, $bar, $item, $qty) {
		$em = $this->getDoctrine()->getManager();

		$transaction = new Transaction("buy");

		$item = $em->getRepository('BRBarBundle:Stock\StockItem')->find($item);
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
