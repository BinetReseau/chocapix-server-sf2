<?php
namespace BR\BarBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Friend
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="User") */
    private $user1;
    /** @ORM\ManyToOne(targetEntity="User") */
    private $user2;

    /** @ORM\Column(type="integer") */
    private $relationcount;
}
