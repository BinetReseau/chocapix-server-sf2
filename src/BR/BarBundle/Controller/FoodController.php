<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FoodController extends Controller {

	public function getFoodsAction(Request $request, $bar) {
		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Food');

		$foods = $repository->createQueryBuilder('f')
				->orderBy('f.name', 'ASC')
				->getQuery()->getResult();

		return $this->render('BRBarBundle:Food:listFoods.html.twig', array('bar' => $bar, 'foods' => $foods));
	}

}
