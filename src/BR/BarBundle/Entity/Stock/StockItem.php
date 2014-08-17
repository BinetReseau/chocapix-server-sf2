<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

use BR\BarBundle\Entity\Operation\StockOperation;

/**
 * @ORM\Entity
 * @GenerateType("item", gen_type=true, gen_typeid=true)
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
     */
    private $bar;

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

    /** @ORM\Column(type="boolean") */
    private $deleted;

    public function __construct($bar) {
        $this->bar = $bar;
        $this->deleted = false;
        $this->qty = 0;
        $this->unit = "";
        $this->tax = 0;
        $this->keywords = "";
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

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getBar() {
        return $this->bar;
    }

    public function setBar($bar) {
        $this->bar = $bar;
        return $this;
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

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($value) {
        $this->deleted = $value;
        return $this;
    }
}
