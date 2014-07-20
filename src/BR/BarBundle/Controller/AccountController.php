<?php
namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use BR\BarBundle\Entity\Bar\Bar;

class AccountController extends FOSRestController {
	/**
	 * @Get("/{bar}/account")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View(serializerEnableMaxDepthChecks=true)
     */
	public function getAccountsAction(Bar $bar) {
		$qb = $this->getDoctrine()->getRepository('BRBarBundle:Account\Account')
				->createQueryBuilder('a')
				->select('a, u')
				->leftjoin('a.user', 'u')
				->where('a.bar = :bar')
				->orderBy('u.name', 'ASC')
				->setParameter('bar', $bar);

		return $qb->getQuery()->getResult();
	}

	/**
	 * @Get("/{bar}/account/me")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View(serializerGroups={"Default"})
     *
     * @Security("is_granted('ACCOUNT', bar)")
     */
	public function getMyAccountAction(Bar $bar) {
		return $this->getDoctrine()->getRepository('BR\BarBundle\Entity\Account\Account')
                ->findFromUserAndBar($this->getUser(), $bar);
	}
}
