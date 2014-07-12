<?php
namespace BR\BarBundle\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as JMS;

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
     * @JMS\Groups({"auth"})
	 */
    private $login;

    /**
	 * @ORM\Column(type="string", length=64)
     * @JMS\Exclude
	 */
    private $password;


    /**
	 * @ORM\OneToOne(targetEntity="\BR\BarBundle\Entity\Account\Account", mappedBy="user")
     * @JMS\Exclude
	 */
    private $account;



    /**
     * @JMS\Groups({"account"})
     * @JMS\SerializedName("money")
     * @JMS\VirtualProperty
     */
    public function getMoney()
    {
        return $this->account->getMoney();
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
