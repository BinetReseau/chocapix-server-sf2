<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\StockOperation;

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

    public function __construct($bar) {
        $this->bar = $bar;
    }


    public function operation($transaction, $deltaqty)
    {
        $op = new StockOperation($transaction, $this, $deltaqty);
        $transaction->addOperation($op);
        $this->qty += $deltaqty;
        return $op;
    }


    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setQty($qty) {
        $this->qty = $qty;
        return $this;
    }

    public function getQty() {
        return $this->qty;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
        return $this;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setTax($tax) {
        $this->tax = $tax;
        return $this;
    }

    public function getTax() {
        return $this->tax;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
        return $this;
    }

    public function getKeywords() {
        return $this->keywords;
    }
}
