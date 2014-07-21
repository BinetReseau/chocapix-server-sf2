<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Auth\User;
use BR\BarBundle\Entity\Account\Account;

class AccountController extends FOSRestController {
	/**
	 * @Get("/{bar}/account")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getAccountsAction(Bar $bar) {
		return $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromBar($bar);
	}

	/**
	 * @Get("/{bar}/account/by-user/{user}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("user", class="BRBarBundle:Auth\User", options={"id" = "user"})
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getAccountByUserAction(Bar $bar, User $user) {
		return $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($user, $bar);
	}

	/**
	 * @Get("/{bar}/account/me")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View(serializerGroups={"Default"})
     *
     * @Security("is_granted('ACCOUNT', bar)")
     */
	public function getMyAccountAction(Bar $bar) {
		return $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($this->getUser(), $bar);
	}

	/**
	 * @Get("/{bar}/account/{account}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("account", class="BRBarBundle:Account\Account", options={"id" = "account"})
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getAccountAction(Bar $bar, Account $account) {
		return $account;
	}

}
