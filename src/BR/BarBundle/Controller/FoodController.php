<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;

class FoodController extends FOSRestController {

	/** @Get("/{bar}/food") */
	public function getFoodsAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$foods = $repository->createQueryBuilder('f')
		        ->where('f.bar = :bar')
				->orderBy('f.name', 'ASC')
				->setParameter('bar', $bar)
				->getQuery()->getResult();

		return $this->handleView($this->view($foods, 200));
	}

	/** @Get("/{bar}/food/{id}") */
	public function getFoodAction(Request $request, $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$food = $repository->find($id);

		return $this->handleView($this->view($food, 200));
	}

	/** @Get("/{bar}/food/search/{q}") */
	public function searchFoodsAction(Request $request, $bar, $q) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$foods = $repository->createQueryBuilder('f')
				->where('f.name LIKE :q')
				->orderBy('f.name', 'ASC')
				->setParameter('q', '%'.$q.'%')
				->getQuery()->getResult();

		return $this->handleView($this->view($foods, 200));
	}

}
