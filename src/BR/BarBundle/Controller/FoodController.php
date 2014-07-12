<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Stock\StockItem;

class FoodController extends FOSRestController {

	/**
	 * @Get("/{bar}/food")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @View()
     */
	public function getFoodsAction(Bar $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Stock\StockItem');

		$foods = $repository->createQueryBuilder('f')
		        ->where('f.bar = :bar')
				->orderBy('f.name', 'ASC')
				->setParameter('bar', $bar->getId())
				->getQuery()->getResult();

		return $foods;
	}

	/**
	 * @Get("/{bar}/food/{id}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
     * @View()
     */
	public function getFoodAction(Bar $bar, StockItem $item) {
		return $item;
	}

	/**
	 * @Get("/{bar}/food/search/{q}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @View()
     */
	public function searchFoodsAction(Bar $bar, $q) {
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
