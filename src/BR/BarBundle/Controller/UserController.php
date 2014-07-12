<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;

class UserController extends FOSRestController {

	/**
	 * @Get("/{bar}/user")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @View(serializerGroups={"Default", "account"})
     */
	public function getUsersAction(Bar $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$users = $repository->createQueryBuilder('u')
		        ->where('u.bar = :bar')
				->orderBy('u.name', 'ASC')
				->setParameter('bar', $bar->getId())
				->getQuery()->getResult();

		return $users;
	}

	/**
	 * @Get("/{bar}/user/{id}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @View(serializerGroups={"Default", "account"})
     */
	public function getUserAction(Bar $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$user = $repository->createQueryBuilder('u')
		        ->where('u.id = :id')
		        ->andWhere('u.bar = :bar')
				->orderBy('u.name', 'ASC')
				->setParameter('id', $id)
				->setParameter('bar', $bar->getId())
				->getQuery()->getSingleResult();

		return $user;
	}
}
