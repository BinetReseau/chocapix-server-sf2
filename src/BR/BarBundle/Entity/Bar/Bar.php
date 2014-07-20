<?php
namespace BR\BarBundle\Entity\Bar;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Bar
{
    /** @ORM\Id @ORM\Column(type="string") */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;


    public function getId() {
        return $this->id;
    }
}
