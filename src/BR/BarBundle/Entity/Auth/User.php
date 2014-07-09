<?php
namespace BR\BarBundle\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/** @ORM\Entity */
class User implements UserInterface
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;


    /** @ORM\Column(type="string", length=50) */
    private $name;

    /** @ORM\ManyToMany(targetEntity="Role", fetch="EAGER") */
    private $roles;


    /** @ORM\Column(type="string", length=64) */
    private $pwd;

    /** @ORM\Column(type="string", length=50, unique=true) */
    private $login;


    /** @ORM\OneToOne(targetEntity="\BR\BarBundle\Entity\Client\Client") */
    private $client;
    
    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Bar")
     *  @ORM\JoinColumn(name="bar", referencedColumnName="id")
     */
    private $bar;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }


    public function getUsername()
    {
        return $this->login;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->pwd;
    }

    public function getRoles()
    {
        return $this->roles->toArray();
    }

    public function eraseCredentials()
    {
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set pwd
     *
     * @param string $pwd
     * @return User
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set client
     *
     * @param \BR\BarBundle\Entity\Client\Client $client
     * @return User
     */
    public function setClient(\BR\BarBundle\Entity\Client\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \BR\BarBundle\Entity\Client\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add roles
     *
     * @param \BR\BarBundle\Entity\Auth\Role $roles
     * @return User
     */
    public function addRole(\BR\BarBundle\Entity\Auth\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \BR\BarBundle\Entity\Auth\Role $roles
     */
    public function removeRole(\BR\BarBundle\Entity\Auth\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Set bar
     *
     * @param \BR\BarBundle\Entity\Bar $bar
     * @return User
     */
    public function setBar(\BR\BarBundle\Entity\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \BR\BarBundle\Entity\Bar 
     */
    public function getBar()
    {
        return $this->bar;
    }
}
