<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;

class UserController extends FOSRestController {

	/**
	 * @Get("/{bar}/user")
     * @View(serializerGroups={"Default", "user"})
     */
	public function getUsersAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$users = $repository->createQueryBuilder('u')
		        ->where('u.bar = :bar')
				->orderBy('u.name', 'ASC')
				->setParameter('bar', $bar)
				->getQuery()->getResult();

		return $users;
	}

	/**
	 * @Get("/{bar}/user/{id}")
     * @View()
     */
	public function getUserAction(Request $request, $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$users = $repository->createQueryBuilder('u')
		        ->where('u.id = :id')
		        ->andWhere('u.bar = :bar')
				->orderBy('u.name', 'ASC')
				->setParameter('id', $id)
				->setParameter('bar', $bar)
				->getQuery()->getResult();

		return $users;
	}

}
