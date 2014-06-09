<?php
namespace BR\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="BR\BarBundle\Entity\TransactionRepository") */
class Transaction
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="datetime") */
    private $timestamp;

    /** @ORM\Column(type="string") */
    private $type;
}
