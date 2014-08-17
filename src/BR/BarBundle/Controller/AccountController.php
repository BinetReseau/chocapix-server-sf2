<?php
namespace BR\BarBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Auth\User;
use BR\BarBundle\Entity\Account\Account;

class AccountController extends FOSRestController {
    /**
     * @Get("/{bar}/account")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     *
     * @View()
     */
    public function getAccountsAction(Bar $bar) {
        $accounts = $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromBar($bar);
        return $this->createForm('collection', $accounts, array('type' => 'account'));
    }

    /**
     * @Get("/{bar}/account/me")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     *
     * @View()
     *
     * @Security("is_granted('ACCOUNT', bar)")
     */
    public function getMyAccountAction(Bar $bar) {
        $account = $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($this->getUser(), $bar);
        return $this->createForm('account', $account);
    }

    /**
     * @Get("/{bar}/account/{id}")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @ParamConverter("account", class="BRBarBundle:Account\Account", options={"id" = "id"})
     *
     * @View()
     */
    public function getAccountAction(Bar $bar, Account $account) {
        return $this->createForm('account', $account);
    }

//
//  /**
//   * @Get("/{bar}/account/by-user/{user}")
//   * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
//   * @ParamConverter("user", class="BRBarBundle:Auth\User", options={"id" = "user"})
//   *
//     * @View()
//     */
//  public function getAccountByUserAction(Bar $bar, User $user) {
//      return $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
//                ->findFromUserAndBar($user, $bar);
//  }

}
