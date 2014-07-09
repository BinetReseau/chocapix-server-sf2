<?php
namespace BR\BarBundle\Entity\Stock;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
/* @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Stock\StockRepository") */
class StockItem
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;


    /** @ORM\Column(type="string", length=255) */
    private $name;


    /** @ORM\Column(type="decimal") */
    private $qty;

    /** @ORM\Column(type="string", length=255) */
    private $unit;

    /** @ORM\Column(type="decimal", scale=3) */
    private $price;

    /** @ORM\Column(type="decimal") */
    private $tax;
    
    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Bar")
     *  @ORM\JoinColumn(name="bar", referencedColumnName="name")
     */
    private $bar;
    
    /** @ORM\Column(type="text") */
    private $keywords;


    /**
     * Set id
     *
     * @param integer $id
     * @return StockItem
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
     * Set name
     *
     * @param string $name
     * @return StockItem
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set qty
     *
     * @param string $qty
     * @return StockItem
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return string 
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return StockItem
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return StockItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set tax
     *
     * @param string $tax
     * @return StockItem
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string 
     */
    public function getTax()
    {
        return $this->tax;
    }
    
    /**
     * Set bar
     *
     * @param \BR\BarBundle\Entity\Bar $bar
     * @return StockItem
     */
    public function setBar(\BR\BarBundle\Entity\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \BR\BarBundle\Entity\Bar 
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return StockItem
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}
