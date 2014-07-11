<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AuthController extends FOSRestController {
	/**
	 * @Post("/{bar}/auth/login")
     * @View(serializerGroups={"Default", "auth", "account"})
	 */
	public function loginAction(Request $request, $bar) {
		$login = $request->request->get('login');
		$password = $request->request->get('password');

		if($login == null || $password == null)
			throw new UnauthorizedHttpException('Bad credentials');

		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$users = $repository->createQueryBuilder('u')
				->where('u.bar = :bar')
				->andWhere('u.login = :login')
				->setParameter('bar', $bar)
				->setParameter('login', $login)
				->getQuery()->getResult();

		if(sizeof($users) != 1)
			throw new UnauthorizedHttpException('Bad credentials');

		$user = $users[0];

		$pwdEncoder = $this->get('security.encoder_factory')->getEncoder($user);
		$valid = $pwdEncoder->isPasswordValid(
				$user->getPassword(), // the encoded password
				$password,            // the submitted password
				$user->getSalt()
			);
		if(!$valid)
			throw new UnauthorizedHttpException('Bad credentials');

		$payload = array(
				'exp' => time() + $this->container->getParameter('lexik_jwt_authentication.token_ttl'),
				'username' => $user->getUsername()
			);

		$jwt = $this->get('lexik_jwt_authentication.jwt_encoder')->encode($payload)->getTokenString();

		return array('token' => $jwt, 'url_safe_token' => urlencode($jwt), 'user' => $user);
	}


	/**
     * @Security("has_role('ROLE_USER')")
	 * @Get("/{bar}/auth/me")
     * @View(serializerGroups={"Default", "auth", "account"})
     */
	public function getMeAction(Request $request, $bar) {
		return $this->getUser();
	}
}
