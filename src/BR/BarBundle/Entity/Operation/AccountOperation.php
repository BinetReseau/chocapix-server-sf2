<?php
namespace BR\BarBundle\Entity\Operation;

use Doctrine\ORM\Mapping as ORM;

use BR\BarBundle\Entity\Account\Account;

/**
 * @ORM\Entity
 * @ORM\Table(name="op_Account")
 */
class AccountOperation extends Operation
{
    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Account\Account") */
    private $account;

    /** @ORM\Column(type="decimal", precision=7, scale=3) */
    private $deltamoney;

    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $oldmoney;


    public function __construct($transaction, $account, $deltamoney)
    {
        parent::__construct($transaction);
        $this->account = $account;
        $this->deltamoney = $deltamoney;
        $this->oldmoney = $account->getMoney();
    }



    public function getAccount() {
        return $this->account;
    }


    public function setDeltamoney($deltamoney) {
        $this->deltamoney = $deltamoney;
        return $this;
    }

    public function getDeltamoney() {
        return $this->deltamoney;
    }


    public function setOldmoney($oldmoney) {
        $this->oldmoney = $oldmoney;
        return $this;
    }

    public function getOldmoney() {
        return $this->oldmoney;
    }
}
