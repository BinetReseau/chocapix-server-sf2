<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Account
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="decimal") */
    private $money;


    public function operation($transaction, $deltamoney)
    {
        $this->money += $deltamoney;
        $op = new AccountOperation($transaction, $this, $deltamoney);
        $transaction->addOperation($op);
        return $op;
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
     * Set money
     *
     * @param string $money
     * @return Account
     */
    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

    /**
     * Get money
     *
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
    }
}
