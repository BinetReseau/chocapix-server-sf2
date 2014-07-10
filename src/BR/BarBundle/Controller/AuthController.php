<?php

namespace BR\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;

class AuthController extends FOSRestController {

	 // * @QueryParam(name="login", default="")
	 // * @QueryParam(name="password", default="")
	 // * @Post("/{bar}/auth/login")
	/**
	 * @Get("/{bar}/auth/login")
	 */
	public function loginAction(Request $request, $bar) {
		$valid = false;
		$login = $request->query->get('login');
		$password = $request->query->get('password');

		if($login != null && $password != null) {
			$repository = $this->getDoctrine()
					->getRepository('BRBarBundle:Auth\User');

			$users = $repository->createQueryBuilder('u')
					->where('u.bar = :bar')
					->andWhere('u.login = :login')
					->setParameter('bar', $bar)
					->setParameter('login', $login)
					->getQuery()->getResult();

			$valid = (sizeof($users) == 1);
		}

		if($valid) {
			$user = $users[0];
			$pwdEncoder = $this->get('security.encoder_factory')->getEncoder($user);
			$valid = $pwdEncoder->isPasswordValid(
				$user->getPassword(), // the encoded password
				$password,            // the submitted password
				$user->getSalt()
			);
		}

		if($valid) {
			$payload = array(
				'exp' => time() + $this->container->getParameter('lexik_jwt_authentication.token_ttl'),
				'username' => $user->getUsername()
				);

			$jwt = $this->get('lexik_jwt_authentication.jwt_encoder')->encode($payload)->getTokenString();

			return $this->handleView($this->view(array('token' => $jwt), 200));
		} else {
			return new JsonResponse('Bad credentials', 401);
		}
	}
}
