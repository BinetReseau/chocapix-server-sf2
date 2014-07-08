<?php
namespace BR\BarBundle\Entity\Auth\OAuth;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\OAuthServerBundle\Model\ClientInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="OAuth_AuthCode")
 */
class AuthCode extends BaseAuthCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Auth\User")
     */
    protected $user;

    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get client
     *
     * @return \BR\BarBundle\Entity\Auth\OAuth\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get user
     *
     * @return \BR\BarBundle\Entity\Auth\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
