<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;

class AuthController extends FOSRestController {

	/** @Post("/{bar}/auth/login") */
	public function loginAction(Request $request, $bar) {
		// $repository = $this->getDoctrine()
		// 		->getRepository('BRBarBundle:Food\Food');

		// $foods = $repository->createQueryBuilder('f')
		// 		->orderBy('f.name', 'ASC')
		// 		->getQuery()->getResult();

		// return $this->handleView($this->view($foods, 200));
	}

	/** @Post("/{bar}/auth/logout") */
	public function logoutAction(Request $request, $bar) {
		// $repository = $this->getDoctrine()
		// 		->getRepository('BRBarBundle:Food\Food');

		// $foods = $repository->createQueryBuilder('f')
		// 		->where('f.name LIKE :q')
		// 		->orderBy('f.name', 'ASC')
		// 		->setParameter('q', '%'.$q.'%')
		// 		->getQuery()->getResult();

		// return $this->handleView($this->view($foods, 200));
	}

}
