<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Operation\Operation;

/** @ORM\Entity */
class AccountOperation extends Operation
{
    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account;

    /** @ORM\Column(type="decimal") */
    private $deltamoney;
    /** @ORM\Column(type="decimal") */
    private $newmoney;


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
