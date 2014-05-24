<?php
namespace BR\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=255)
     */
    private $pwd;
    
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="money", type="decimal")
     */
    private $money;
    
    public function __toString() {
        return $this->name;
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name) {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set pwd
     *
     * @param string $pwd
     * @return User
     */
    public function setPwd($pwd) {
        $this->pwd = $pwd;
        
        return $this;
    }
    
    /**
     * Get pwd
     *
     * @return string
     */
    public function getPwd() {
        return $this->pwd;
    }
    
    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login) {
        $this->login = $login;
        
        return $this;
    }
    
    /**
     * Get login
     *
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }
    
    /**
     * Set money
     *
     * @param string $money
     * @return User
     */
    public function setMoney($money) {
        $this->money = $money;
        
        return $this;
    }
    
    /**
     * Get money
     *
     * @return string
     */
    public function getMoney() {
        return $this->money;
    }
}
