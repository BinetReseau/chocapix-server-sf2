<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;

class FoodController extends FOSRestController {

	/**
	 * @Get("/{bar}/food")
     * @View()
     */
	public function getFoodsAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$foods = $repository->createQueryBuilder('f')
		        ->where('f.bar = :bar')
				->orderBy('f.name', 'ASC')
				->setParameter('bar', $bar)
				->getQuery()->getResult();

		return $foods;
	}

	/**
	 * @Get("/{bar}/food/{id}")
     * @View()
     */
	public function getFoodAction(Request $request, $bar, $id) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$food = $repository->find($id);

		return $food;
	}

	/**
	 * @Get("/{bar}/food/search/{q}")
     * @View()
     */
	public function searchFoodsAction(Request $request, $bar, $q) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$foods = $repository->createQueryBuilder('f')
				->where('f.name LIKE :q')
				->orWhere('f.keywords LIKE :q2')
				->orderBy('f.name', 'ASC')
				->setParameter('q', '%'.$q.'%')
				->setParameter('q2', '%'.$q.'%')
				->getQuery()->getResult();

		return $foods;
	}

}
