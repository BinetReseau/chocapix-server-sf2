<?php
namespace BR\BarBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="BR\BarBundle\Entity\User\UserRepository") */
class User
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;


    /** @ORM\Column(type="string", length=255) */
    private $name;

    /** @ORM\Column(type="string", length=255) */
    private $pwd;

    /** @ORM\Column(type="string", length=255) */
    private $login;


    /** @ORM\Column(type="decimal") */
    private $money;
}
