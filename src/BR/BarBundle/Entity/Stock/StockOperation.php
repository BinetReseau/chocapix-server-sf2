<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Transaction as Transaction;

/** @ORM\Entity */
class StockOperation
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Transaction") */
    private $transaction;

    /** @ORM\ManyToOne(targetEntity="StockItem") */
    private $item;

    /** @ORM\Column(type="decimal") */
    private $deltaqty;

    /** @ORM\Column(type="decimal") */
    private $newqty;


    /**
     * Set id
     *
     * @param integer $id
     * @return StockOperation
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
     * Set deltaqty
     *
     * @param string $deltaqty
     * @return StockOperation
     */
    public function setDeltaqty($deltaqty)
    {
        $this->deltaqty = $deltaqty;

        return $this;
    }

    /**
     * Get deltaqty
     *
     * @return string 
     */
    public function getDeltaqty()
    {
        return $this->deltaqty;
    }

    /**
     * Set newqty
     *
     * @param string $newqty
     * @return StockOperation
     */
    public function setNewqty($newqty)
    {
        $this->newqty = $newqty;

        return $this;
    }

    /**
     * Get newqty
     *
     * @return string 
     */
    public function getNewqty()
    {
        return $this->newqty;
    }

    /**
     * Set transaction
     *
     * @param \BR\BarBundle\Entity\Transaction $transaction
     * @return StockOperation
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
     * Set item
     *
     * @param \BR\BarBundle\Entity\Stock\StockItem $item
     * @return StockOperation
     */
    public function setItem(\BR\BarBundle\Entity\Stock\StockItem $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \BR\BarBundle\Entity\Stock\StockItem 
     */
    public function getItem()
    {
        return $this->item;
    }
}
