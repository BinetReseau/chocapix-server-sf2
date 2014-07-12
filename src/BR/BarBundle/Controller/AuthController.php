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
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends FOSRestController {
	/**
	 * @Post("/{bar}/auth/login")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 * @RequestParam(name="login", strict=true)
	 * @RequestParam(name="password", strict=true)
	 *
     * @View(serializerGroups={"Default", "auth", "account"})
	 */
	public function loginAction(Bar $bar, $login, $password) {
		if($login == null || $password == null)
			throw new UnauthorizedHttpException('Bad credentials');

		$repository = $this->getDoctrine()
				->getRepository('BRBarBundle:Auth\User');

		$users = $repository->createQueryBuilder('u')
				->where('u.login = :login')
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
	 * @Get("/{bar}/auth/me")
	 * @ParamConverter("bar", class="BRBarBundle:Bar\Bar", options={"id" = "bar"})
	 *
     * @View(serializerGroups={"Default", "auth", "account"})
     *
     * @Security("has_role('ROLE_USER')")
     */
	public function getMyUserAction(Bar $bar) {
		return $this->getUser();
	}
}
