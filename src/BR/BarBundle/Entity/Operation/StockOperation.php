<?php
namespace BR\BarBundle\Entity\Operation;

use Doctrine\ORM\Mapping as ORM;

use BR\BarBundle\Entity\Stock\StockItem;

/**
 * @ORM\Entity
 * @ORM\Table(name="op_Stock")
 */
class StockOperation extends Operation
{
    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Stock\StockItem") */
    private $item;

    /** @ORM\Column(type="decimal", precision=7, scale=3) */
    private $deltaqty;

    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $oldqty;


    public function __construct($transaction, $item, $deltaqty)
    {
        parent::__construct($transaction);
        $this->item = $item;
        $this->deltaqty = $deltaqty;
        $this->oldqty = $item->getQty();
    }

    public function getMoneyFlow() {
        return $this->deltaqty * $this->item->getPrice();
    }


    public function setDeltaqty($deltaqty) {
        $this->deltaqty = $deltaqty;
        return $this;
    }

    public function getDeltaqty() {
        return $this->deltaqty;
    }


    public function setOldqty($oldqty) {
        $this->oldqty = $oldqty;
        return $this;
    }

    public function getOldqty() {
        return $this->oldqty;
    }


    public function getItem() {
        return $this->item;
    }
}
