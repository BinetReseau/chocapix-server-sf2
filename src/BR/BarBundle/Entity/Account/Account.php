<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

use BR\BarBundle\Entity\Operation\AccountOperation;

/**
 * @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Account\AccountRepository")
 * @GenerateType("account", gen_type=true, gen_typeid=true)
 */
class Account
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Bar\Bar") */
    private $bar;

    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Auth\User", inversedBy="accounts") */
    private $user;

    /** @ORM\Column(type="decimal", precision=9, scale=3) */
    private $money;


    public function operation($transaction, $deltamoney) {
        $op = new AccountOperation($transaction, $this, $deltamoney);
        $transaction->addOperation($op);
        $this->money += $deltamoney;
        return $op;
    }


    public function getId() {
        return $this->id;
    }

    public function setMoney($money) {
        $this->money = $money;
        return $this;
    }

    public function getMoney() {
        return $this->money;
    }

    public function setBar(\BR\BarBundle\Entity\Bar\Bar $bar = null) {
        $this->bar = $bar;
        return $this;
    }

    public function getBar() {
        return $this->bar;
    }

    public function setUser(\BR\BarBundle\Entity\Auth\User $user = null) {
        $this->user = $user;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }
}
