<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class AccountOperation
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Transaction") */
    private $transaction;

    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account;

    /** @ORM\Column(type="decimal") */
    private $deltamoney;
    /** @ORM\Column(type="decimal") */
    private $newmoney;


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
     * Set deltamoney
     *
     * @param string $deltamoney
     * @return AccountOperation
     */
    public function setDeltamoney($deltamoney)
    {
        $this->deltamoney = $deltamoney;

        return $this;
    }

    /**
     * Get deltamoney
     *
     * @return string 
     */
    public function getDeltamoney()
    {
        return $this->deltamoney;
    }

    /**
     * Set newmoney
     *
     * @param string $newmoney
     * @return AccountOperation
     */
    public function setNewmoney($newmoney)
    {
        $this->newmoney = $newmoney;

        return $this;
    }

    /**
     * Get newmoney
     *
     * @return string 
     */
    public function getNewmoney()
    {
        return $this->newmoney;
    }

    /**
     * Set transaction
     *
     * @param \BR\BarBundle\Entity\Transaction $transaction
     * @return AccountOperation
     */
    public function setTransaction(\BR\BarBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \BR\BarBundle\Entity\Transaction 
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set account
     *
     * @param \BR\BarBundle\Entity\Account\Account $account
     * @return AccountOperation
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
