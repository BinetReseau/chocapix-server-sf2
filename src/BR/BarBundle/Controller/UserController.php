<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;

class UserController extends FOSRestController {
	/**
	 * @Get("/{bar}/user")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View()
     */
	public function getUsersAction(Bar $bar) {
		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Account\Account')
				->createQueryBuilder('a')
				->select('IDENTITY(a.user)')
				->where('a.bar = :bar');

		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Auth\User')
				->createQueryBuilder('u')
				->select('u', 'account')
				->leftjoin('u.accounts', 'account', 'WITH', 'account.bar = :bar')
				->where('u.id IN ('.$qb->getDQL().')')
				->orderBy('u.name', 'ASC')
				->setParameter('bar', $bar);

		return $qb->getQuery()->getResult();
	}

	/**
	 * @Get("/{bar}/user/{id}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View()
     */
	public function getUserAction(Bar $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$user = $repository->createQueryBuilder('u')
				->select('u', 'account')
				->leftjoin('u.accounts', 'account', 'WITH', 'account.bar = :bar')
		        ->where('u.id = :id')
				->setParameter('id', $id)
				->getQuery()->getSingleResult();

		return $user;
	}
}
