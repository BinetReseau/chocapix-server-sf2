<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Stock\StockItem;
use BR\BarBundle\Entity\Transaction\Transaction;
use BR\BarBundle\Entity\Transaction\ApproTransaction;

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
				->setParameter('bar', $bar)
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

	/**
	 * @Post("/{bar}/food/add")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="name")
	 * @RequestParam(name="unit")
	 * @RequestParam(name="price", requirements="[0-9.]+", strict=true)
	 * @RequestParam(name="tax", requirements="[0-9.]+", strict=true)
	 * @RequestParam(name="qty")
	 * @RequestParam(name="keywords")
	 * @View()
	 */
	public function addStockItemAction(Bar $bar, $name, $unit, $price, $tax, $qty = 0, $keywords = '') {
		$em = $this->getDoctrine()->getManager();
		
		$item = new StockItem($bar);
		$item->setName($name);
		$item->setUnit($unit);
		$item->setPrice($price);
		$item->setTax($tax);
		$item->setKeywords($keywords);
		$item->setQty(0);

		$em->persist($item);

		if ($qty > 0) {
			$appro = new ApproTransaction($bar, $this->getUser());
			$item->operation($appro, $qty);

			if(!$appro->checkIntegrity())
				throw new \Exception('Invalid Transaction');

			$em->persist($appro);
		}

		$em->flush();

		return $item;
	}

	/**
	 * @Post("/{bar}/food/{item}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 * @RequestParam(name="name")
	 * @RequestParam(name="unit")
	 * @RequestParam(name="price", requirements="[0-9.]+", strict=true)
	 * @RequestParam(name="tax", requirements="[0-9.]+", strict=true)
	 * @View()
	 */
	public function updateStockItemAction($bar, StockItem $item, $name, $unit, $price, $tax, $qty, $keywords) {
		# code...
	}

	/**
	 * @Delete("/{bar}/food/{item}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 *
	 * @View()
	 */
	public function deleteStockItemAction($bar, StockItem $item) {
		$em = $this->getDoctrine()->getManager();
		$item->setDeleted(true);
		$em->persist($item);
		$em->flush();
		return $item;
	}

	/**
	 * @Post("/{bar}/food/undelete/{item}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "item"})
	 *
	 * @View()
	 */
	public function undeleteStockItemAction($bar, StockItem $item) {
		$em = $this->getDoctrine()->getManager();
		$item->setDeleted(false);
		$em->persist($item);
		$em->flush();
		return $item;
	}
}
