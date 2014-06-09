<?php
namespace BR\BarBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Entity\Transaction as Transaction;

/** @ORM\Entity */
class UserOperation
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Transaction") */
    private $transaction;

    /** @ORM\ManyToOne(targetEntity="User") */
    private $user;

    /** @ORM\Column(type="decimal") */
    private $deltamoney;
    /** @ORM\Column(type="decimal") */
    private $newmoney;
}
