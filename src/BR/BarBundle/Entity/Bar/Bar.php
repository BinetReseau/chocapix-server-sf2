<?php
namespace BR\BarBundle\Entity\Bar;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

/**
 * @ORM\Entity
 * @GenerateType("bar", gen_typeid=true)
 */
class Bar
{
    /** @ORM\Id @ORM\Column(type="string") */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;


    public function getId() {
        return $this->id;
    }

    public function getName() {
    	return $this->name;
    }
}
