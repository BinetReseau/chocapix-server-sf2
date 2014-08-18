<?php
namespace BR\BarBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

use BR\BarBundle\Entity\Bar\Bar;
use BR\BarBundle\Entity\Stock\StockItem;

class FoodController extends FOSRestController {
    /**
     * @Get("/{bar}/food")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     *
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

        return $this->createForm('collection', $foods, array('type' => 'item'));
    }

    /**
     * @Post("/{bar}/food")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     *
     * @View()
     */
    public function createFoodAction(Request $request, $bar) {
        $item = new StockItem($bar);
        $form = $this->createForm('item', $item);

        $form->submit($request->request->all(), false);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            return $this->createForm('item', $item);
        } else {
            return $form;
        }
    }

    /**
     * @Get("/{bar}/food/{id}")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "id"})
     *
     * @View()
     */
    public function getFoodAction(Bar $bar, StockItem $item) {
        return $this->createForm('item', $item);
    }


    /**
     * @Put("/{bar}/food/{id}")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "id"})
     *
     * @View()
     */
    public function updateFoodAction(Request $request, $bar, StockItem $item) {
        $form = $this->createForm('item', $item);

        $form->submit($request->request->all(), false);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
        }
        return $form;
    }

    /**
     * @Put("/{bar}/food/{id}/markDeleted")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "id"})
     *
     * @View()
     */
    public function deleteFoodAction($bar, StockItem $item) {
        $em = $this->getDoctrine()->getManager();
        $item->setDeleted(true);
        $em->persist($item);
        $em->flush();
        return $this->createForm('item', $item);
    }

    /**
     * @Put("/{bar}/food/{id}/unMarkDeleted")
     * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @ParamConverter("item", class="BRBarBundle:Stock\StockItem", options={"id" = "id"})
     *
     * @View()
     */
    public function undeleteFoodAction($bar, StockItem $item) {
        $em = $this->getDoctrine()->getManager();
        $item->setDeleted(false);
        $em->persist($item);
        $em->flush();
        return $this->createForm('item', $item);
    }
}
