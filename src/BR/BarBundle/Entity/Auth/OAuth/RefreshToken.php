<?php
namespace BR\BarBundle\Entity\Auth\OAuth;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="OAuth_RefreshToken")
 */
class RefreshToken extends BaseRefreshToken
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
     * Set client
     *
     * @param \BR\BarBundle\Entity\Auth\OAuth\Client $client
     * @return RefreshToken
     */
    public function setClient(\BR\BarBundle\Entity\Auth\OAuth\Client $client)
    {
        $this->client = $client;

        return $this;
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
     * Set user
     *
     * @param \BR\BarBundle\Entity\Auth\User $user
     * @return RefreshToken
     */
    public function setUser(\BR\BarBundle\Entity\Auth\User $user = null)
    {
        $this->user = $user;

        return $this;
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
