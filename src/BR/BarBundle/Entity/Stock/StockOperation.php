<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Operation\Operation;

/** @ORM\Entity */
class StockOperation extends Operation
{
    /** @ORM\ManyToOne(targetEntity="StockItem") */
    private $item;

    /** @ORM\Column(type="decimal", precision=7, scale=3) */
    private $deltaqty;

    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $newqty;


    public function __construct($transaction, $item, $deltaqty)
    {
        parent::__construct($transaction);
        $this->item = $item;
        $this->deltaqty = $deltaqty;
        $this->newqty = $item->getQty();
    }
}
