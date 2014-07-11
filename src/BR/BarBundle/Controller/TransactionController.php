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
use BR\BarBundle\Entity\Stock\StockItem;
use BR\BarBundle\Entity\Operation\Transaction;
use BR\BarBundle\Entity\Stock\StockOperation;
use BR\BarBundle\Entity\Account\AccountOperation;

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
				->getQuery()->setMaxResults($limit)->getResult();

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
