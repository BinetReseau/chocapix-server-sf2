<?php
namespace BR\BarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
/* @ORM\Entity(repositoryClass="BR\BarBundle\Entity\BarRepository") */
class Bar
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="string") */
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

    /**
     * Set id
     *
     * @param string $id
     * @return Bar
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
