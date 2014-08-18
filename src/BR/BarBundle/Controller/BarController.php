<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;

class BarController extends FOSRestController {
	/**
	 * @Get("/{bar}/bar")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View()
     */
	public function getBarsAction(Bar $bar) {
		$bars = $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Bar\Bar')
                ->findAll();
        return $this->createForm('collection', $bars, array('type' => 'bar'));
	}

	/**
	 * @Get("/{bar}/bar/{bar2}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @ParamConverter("bar2", class="BRBarBundle:Bar\Bar", options={"id" = "bar2"})
     * @View()
     */
	public function getBarAction(Bar $bar, Bar $bar2) {
        return $this->createForm('bar', $bar2);
	}


	/**
	 * @Get("/{bar}")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
     * @View()
     */
	public function getCurrentBarAction(Bar $bar) {
        return $this->createForm('bar', $bar);
	}
}
