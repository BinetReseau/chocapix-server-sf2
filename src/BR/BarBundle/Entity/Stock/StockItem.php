<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @JMS\ExclusionPolicy("none")
 */
class StockItem
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Bar\Bar")
     * @JMS\Exclude
     */
    private $bar;
    /**
     * @JMS\SerializedName("bar")
     * @JMS\VirtualProperty
     */
    public function getBarId()
    {
        return $this->bar->getId();
    }


    /** @ORM\Column(type="string", length=255) */
    private $name;


    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $qty;

    /** @ORM\Column(type="string", length=255) */
    private $unit;

    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $price;

    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $tax;

    /** @ORM\Column(type="text") */
    private $keywords;


    public function operation($transaction, $deltaqty)
    {
        $this->qty += $deltaqty;
        $op = new StockOperation($transaction, $this, $deltaqty);
        $transaction->addOperation($op);
        return $op;
    }
}
