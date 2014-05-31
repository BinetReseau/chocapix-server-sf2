<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BR\BarBundle\Form\HistoryType;
use BR\BarBundle\Entity\History;

class DefaultController extends Controller {

	public function barHomeAction(Request $request, $bar) {
		$hist = new History();
		$form = $this->createForm(new HistoryType(), $hist);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($hist);
			$em->flush();

			// return $this->redirect($this->generateUrl('task_success'));
		}

		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:History');

		$query = $repository->createQueryBuilder('h')
				->orderBy('h.timestamp', 'ASC')
				->getQuery();

		$histories = $query->getResult();

		return $this->render('BRBarBundle:Default:index.html.twig', array('bar' => $bar, 'form' => $form->createView(), 'histories' => $histories));
	}

}
