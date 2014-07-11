<?php
namespace BR\BarBundle\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class User implements UserInterface, \Serializable
{
    /**
	 * @ORM\Id @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 * @JMS\Expose
	 */
    private $id;

    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Bar\Bar") */
    private $bar;


    /**
	 * @ORM\Column(type="string", length=50)
	 * @JMS\Expose
	 */
    private $name;

    /** @ORM\ManyToMany(targetEntity="Role", fetch="EAGER") */
    private $roles;


    /**
     * @ORM\Column(type="string", length=50)
     * @JMS\Groups({"auth"})
     * @JMS\Expose
	 */
    private $login;

    /**
	 * @ORM\Column(type="string", length=64)
	 */
    private $password;


    /**
	 * @ORM\OneToOne(targetEntity="\BR\BarBundle\Entity\Account\Account")
	 */
    private $account;


	/**
	 * @JMS\SerializedName("bar")
	 * @JMS\VirtualProperty
	 */
    public function getBarId()
    {
        return $this->bar->getId();
    }


    /**
     * @JMS\Groups({"account"})
     * @JMS\SerializedName("money")
     * @JMS\VirtualProperty
     */
    public function getMoney()
    {
        return $this->account->getMoney();
    }


    /**
     * @JMS\Type("array<string>")
     * @JMS\Groups({"auth"})
     * @JMS\SerializedName("roles")
     * @JMS\VirtualProperty
     */
    public function getRoles()
    {
        return array_merge(
            array('ROLE_USER'),
            array_map(function($role) {return $role->getRole();},
                $this->roles->toArray())
        );
    }

    public function __construct()
    {
        parent::__construct();
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
        return $this->password;
    }

    public function eraseCredentials()
    {
    }


    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->bar,
            $this->login,
            $this->password
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->bar,
            $this->login,
            $this->password
        ) = unserialize($serialized);
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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set bar
     *
     * @param \BR\BarBundle\Entity\Bar\Bar $bar
     * @return User
     */
    public function setBar(\BR\BarBundle\Entity\Bar\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \BR\BarBundle\Entity\Bar\Bar 
     */
    public function getBar()
    {
        return $this->bar;
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
     * Set account
     *
     * @param \BR\BarBundle\Entity\Account\Account $account
     * @return User
     */
    public function setAccount(\BR\BarBundle\Entity\Account\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \BR\BarBundle\Entity\Account\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }
}
