<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Operation\Operation;

/** @ORM\Entity */
class StockOperation extends Operation
{
    /** @ORM\ManyToOne(targetEntity="StockItem") */
    private $item;

    /** @ORM\Column(type="decimal") */
    private $deltaqty;

    /** @ORM\Column(type="decimal") */
    private $newqty;


    public function __construct($transaction, $item, $deltaqty)
    {
        parent::__construct($transaction);
        $this->item = $item;
        $this->deltaqty = $deltaqty;
        $this->newqty = $item->getQty();
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
