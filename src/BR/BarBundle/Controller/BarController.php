<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;

class BarController extends FOSRestController {

	/** @Get("/{bar}") */
	public function getBarAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Bar');

		$bar = $repository->find($bar);

		return $this->handleView($this->view($bar, 200));
	}
}
