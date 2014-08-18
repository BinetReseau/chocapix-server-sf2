<?php
namespace BR\BarBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Auth\User;

class UserController extends FOSRestController {
    /**
     * @Get("/{bar}/user")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     *
     * @View()
     */
    public function getUsersAction(Bar $bar) {
        $repository = $this->getDoctrine()
                ->getRepository('BRBarBundle:Auth\User');

        $users = $repository->createQueryBuilder('u')
                ->select('u')
                ->leftjoin('u.accounts', 'account', 'WITH', 'account.bar = :bar')
                ->where('account != 0')
                ->setParameter('bar', $bar)
                ->getQuery()->getResult();
        return $this->createForm('collection', $users, array('type' => 'user'));
    }

    /**
     * @Get("/{bar}/user/{id}")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @ParamConverter("user", class="BRBarBundle:Auth\User", options={"id" = "id"})
     *
     * @View()
     */
    public function getUserAction(Bar $bar, User $user) {
        return $this->createForm('user', $user);
    }
}
