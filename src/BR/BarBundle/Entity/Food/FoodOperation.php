<?php
namespace BR\BarBundle\Entity\Food;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Transaction as Transaction;

/** @ORM\Entity */
class FoodOperation
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Transaction") */
    private $transaction;

    /** @ORM\ManyToOne(targetEntity="Food") */
    private $food;

    /** @ORM\Column(type="decimal") */
    private $deltaqty;
    /** @ORM\Column(type="decimal") */
    private $newqty;
}
