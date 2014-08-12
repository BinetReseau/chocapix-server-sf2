<?php
namespace BR\BarBundle\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @JMS\ExclusionPolicy("none")
 * @GenerateType("user", gen_typeid=true, gen_type=true)
 */
class User implements UserInterface
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
     * @JMS\Exclude
     */
    private $login;


    /**
     * @ORM\Column(type="string", length=64)
     * @JMS\Exclude
     */
    private $password;


    /**
     * @ORM\OneToMany(targetEntity="BR\BarBundle\Entity\Account\Account", mappedBy="user")
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



    public function getAccounts() {
        return $this->accounts;
    }

    public function setAccounts($accounts) {
        $this->accounts = $accounts;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function addAccount(\BR\BarBundle\Entity\Account\Account $accounts) {
        $this->accounts[] = $accounts;
        return $this;
    }

    public function removeAccount(\BR\BarBundle\Entity\Account\Account $accounts) {
        $this->accounts->removeElement($accounts);
    }
}
