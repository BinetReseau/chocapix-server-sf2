<?php
namespace BR\BarBundle\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @JMS\ExclusionPolicy("none")
 */
class User implements UserInterface, \Serializable
{
    /**
	 * @ORM\Id @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
    private $id;


    /**
	 * @ORM\Column(type="string", length=50)
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $login;


    /**
     * @ORM\Column(type="string", length=64)
     * @JMS\Exclude
     */
    private $password;


    /**
     * @ORM\OneToMany(targetEntity="\BR\BarBundle\Entity\Account\Account", mappedBy="user")
     * @JMS\MaxDepth(3)
	 */
    private $accounts;


    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }



    public function getRoles()
    {
        return array('ROLE_USER');
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
}
