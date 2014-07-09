<?php
namespace BR\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
/* @ORM\Entity(repositoryClass="BR\BarBundle\Entity\BarRepository") */
class Bar
{
    /** @ORM\Id @ORM\Column(type="string") */
    private $name;

    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Bar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
