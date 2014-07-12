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

    /**
     * @ORM\OneToOne(targetEntity="\BR\BarBundle\Entity\Auth\User", inversedBy="account")
     */
    private $user;


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

    /**
     * Set user
     *
     * @param \BR\BarBundle\Entity\Auth\User $user
     * @return Account
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
