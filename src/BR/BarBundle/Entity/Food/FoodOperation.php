<?php
namespace BR\BarBundle\Entity\Food;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Transaction as Transaction;

/** @ORM\Entity */
class FoodOperation
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Transaction") */
    private $transaction;

    /** @ORM\ManyToOne(targetEntity="Food") */
    private $food;

    /** @ORM\Column(type="decimal") */
    private $deltaqty;
    /** @ORM\Column(type="decimal") */
    private $newqty;

    /**
     * Set id
     *
     * @param integer $id
     * @return FoodOperation
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
     * @return FoodOperation
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
     * @return FoodOperation
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
     * @param \BR\BarBundle\Entity\Food\Transaction $transaction
     * @return FoodOperation
     */
    public function setTransaction(\BR\BarBundle\Entity\Food\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \BR\BarBundle\Entity\Food\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set food
     *
     * @param \BR\BarBundle\Entity\Food\Food $food
     * @return FoodOperation
     */
    public function setFood(\BR\BarBundle\Entity\Food\Food $food = null)
    {
        $this->food = $food;

        return $this;
    }

    /**
     * Get food
     *
     * @return \BR\BarBundle\Entity\Food\Food
     */
    public function getFood()
    {
        return $this->food;
    }
}
