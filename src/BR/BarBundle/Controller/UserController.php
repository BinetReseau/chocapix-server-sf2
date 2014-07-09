<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;

class UserController extends FOSRestController {

	/** @Get("/{bar}/user") */
	public function getUserssAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$users = $repository->createQueryBuilder('u')
		        ->where('u.bar = :bar')
				->orderBy('u.name', 'ASC')
				->setParameter('bar', $bar)
				->getQuery()->getResult();

		return $this->handleView($this->view($users, 200));
	}

	/** @Get("/{bar}/user/{id}") */
	public function getUserAction(Request $request, $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$user = $repository->find($id);

		return $this->handleView($this->view($food, 200));
	}

}
