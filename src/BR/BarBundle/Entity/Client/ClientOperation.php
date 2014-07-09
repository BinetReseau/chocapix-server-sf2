<?php
namespace BR\BarBundle\Entity\Client;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Transaction as Transaction;

/** @ORM\Entity */
class ClientOperation
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Transaction") */
    private $transaction;

    /** @ORM\ManyToOne(targetEntity="Client") */
    private $user;

    /** @ORM\Column(type="decimal") */
    private $deltamoney;
    /** @ORM\Column(type="decimal") */
    private $newmoney;


    /**
     * Set id
     *
     * @param integer $id
     * @return ClientOperation
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set deltamoney
     *
     * @param string $deltamoney
     * @return ClientOperation
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
     * @return ClientOperation
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
     * @return ClientOperation
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
     * Set user
     *
     * @param \BR\BarBundle\Entity\Client\Client $user
     * @return ClientOperation
     */
    public function setUser(\BR\BarBundle\Entity\Client\Client $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BR\BarBundle\Entity\Client\Client
     */
    public function getUser()
    {
        return $this->user;
    }
}
