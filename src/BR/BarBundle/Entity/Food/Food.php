<?php
namespace BR\BarBundle\Entity\Food;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
/* @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Food\FoodRepository") */
class Food
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;


    /** @ORM\Column(type="string", length=255) */
    private $name;


    /** @ORM\Column(type="decimal") */
    private $qty;

    /** @ORM\Column(type="string", length=255) */
    private $unit;

    /** @ORM\Column(type="decimal") */
    private $price;

    /** @ORM\Column(type="decimal") */
    private $tax;

    /**
     * Set id
     *
     * @param integer $id
     * @return Food
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
     * @return Food
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
     * @return Food
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
     * @return Food
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
     * @return Food
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
     * @return Food
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
}
