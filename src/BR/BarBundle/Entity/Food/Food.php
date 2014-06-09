<?php
namespace BR\BarBundle\Entity\Food;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Food\FoodRepository") */
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
}
