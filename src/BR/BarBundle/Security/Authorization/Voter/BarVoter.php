<?php
namespace BR\BarBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class BarVoter implements VoterInterface
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, array(
            'ACCOUNT'
        ));
    }

    public function supportsClass($class)
    {
        $supportedClass = 'BR\BarBundle\Entity\Bar\Bar';

        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }


    public function vote(TokenInterface $token, $bar, array $attributes)
    {
        if (!$this->supportsClass(get_class($bar))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }


        if(count($attributes) !== 1) {
            throw new InvalidArgumentException(
                'Only one attribute is allowed for BarVoter'
            );
        }

        $attribute = $attributes[0];
        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }


        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }


        switch($attribute) {
            case 'ACCOUNT':
                $accounts = $this->em->getRepository('BR\BarBundle\Entity\Account\Account')
                        ->createQueryBuilder('a')
                        ->where('a.bar = :bar')
                        ->andWhere('a.user = :user')
                        ->setParameter('bar', $bar)
                        ->setParameter('user', $user)
                        ->getQuery()->getResult();

                if (count($accounts) >= 1) {
                    return VoterInterface::ACCESS_GRANTED;
                } else {
                    return VoterInterface::ACCESS_DENIED;
                }
                break;
        }
    }
}
