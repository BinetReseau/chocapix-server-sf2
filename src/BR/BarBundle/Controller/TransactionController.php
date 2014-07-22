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
use BR\BarBundle\Entity\Stock\StockItem;
use BR\BarBundle\Entity\Transaction\Transaction;

class TransactionController extends FOSRestController {
	/**
	 * @Get("/{bar}/transaction")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @QueryParam(name="limit", requirements="\d+", default="0")
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getTransactionsAction(Bar $bar, $limit) {
		return $this->getDoctrine()->getRepository('BRBarBundle:Transaction\Transaction')
				->getTransactionsByBar($bar, $limit);
	}

	/**
	 * @Get("/{bar}/transaction/by-item/{item}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @QueryParam(name="limit", requirements="\d+", default="0")
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getTransactionByItemAction(Bar $bar, StockItem $item, $limit) {
		return $this->getDoctrine()->getRepository('BRBarBundle:Transaction\Transaction')
				->getTransactionsByBarAndItem($bar, $item, $limit);
	}

	/**
	 * @Get("/{bar}/transaction/by-account/{account}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("account", class="BRBarBundle:Account\Account", options={"id" = "account"})
	 * @QueryParam(name="limit", requirements="\d+", default="0")
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getTransactionByAccountAction(Bar $bar, Account $account, $limit) {
		return $this->getDoctrine()->getRepository('BRBarBundle:Transaction\Transaction')
				->getTransactionsByBarAndAccount($bar, $account, $limit);
	}


	/**
	 * @Get("/{bar}/transaction/{transaction}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("transaction", class="BRBarBundle:Transaction\Transaction", options={"id" = "transaction"})
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getTransactionAction(Bar $bar, Transaction $transaction) {
		return $transaction;
	}



	/**
	 * @Post("/{bar}/transaction/cancel/{transaction}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("transaction", class="BRBarBundle:Transaction\Transaction", options={"id" = "transaction"})
	 *
     * @View()
     */
	public function cancelTransactionAction(Bar $bar, Transaction $transaction) {
		$em = $this->getDoctrine()->getManager();

		$transaction->setCanceled(true);

		$repo = $em->getRepository('BRBarBundle:Transaction\Transaction');
		$repo->propagateTransactionModification($transaction);

		$em->flush();
	}
}
