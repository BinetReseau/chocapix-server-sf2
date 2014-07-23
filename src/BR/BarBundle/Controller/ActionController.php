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
use BR\BarBundle\Entity\Transaction\GiveTransaction;
use BR\BarBundle\Entity\Transaction\ThrowTransaction;

class ActionController extends FOSRestController {
	/**
	 * @Post("/{bar}/action/buy")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="item", requirements="\d+", strict=true)
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @RequestParam(name="qty", requirements="[0-9.]+", strict=true)
	 *
     * @View()
     *
     * @Security("is_granted('ACCOUNT', bar)")
     */
	public function buyAction(Bar $bar, StockItem $item, $qty) {
		$em = $this->getDoctrine()->getManager();

		$transaction = new BuyTransaction($bar, $this->getUser());

		$item->operation($transaction, -$qty);

		$account = $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($this->getUser(), $bar);
		$account->operation($transaction, -$qty * $item->getPrice());

		if(!$transaction->checkIntegrity())
			throw new \Exception('Invalid Transaction');

		$em->persist($transaction);
		$em->flush();

		return $transaction;
	}



	/**
	 * @Post("/{bar}/action/give")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="recipient", requirements="\d+", strict=true)
	 * @ParamConverter("recipient", class="BRBarBundle:Account\Account", options={"id" = "recipient"})
	 * @RequestParam(name="qty", requirements="[0-9.]+", strict=true)
	 *
     * @View()
     *
     * @Security("is_granted('ACCOUNT', bar)")
     */
	public function giveAction(Bar $bar, Account $recipient, $qty) {
		$em = $this->getDoctrine()->getManager();

		$transaction = new GiveTransaction($bar, $this->getUser());

		$account = $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($this->getUser(), $bar);
		$account->operation($transaction, -$qty);
		if($account == $recipient)
			throw new \Exception('Cannot give to same account');

		$recipient->operation($transaction, $qty);

		if(!$transaction->checkIntegrity())
			throw new \Exception('Invalid Transaction');

		$em->persist($transaction);
		$em->flush();

		return $transaction;
	}


	/**
	 * @Post("/{bar}/action/throw")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="item", requirements="\d+", strict=true)
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @RequestParam(name="qty", requirements="[0-9.]+", strict=true)
	 *
	 * @View()
	 *
	 * @Security("is_granted('ACCOUNT', bar)")
	 */
	public function throwAction(Bar $bar, StockItem $item, $qty)
	{
		$em = $this->getDoctrine()->getManager();

		$transaction = new ThrowTransaction($bar, $this->getUser());

		$item->operation($transaction, -$qty);

		if(!$transaction->checkIntegrity())
			throw new \Exception('Invalid Transaction');

		$em->persist($transaction);
		$em->flush();

		return $transaction;
	}
}
