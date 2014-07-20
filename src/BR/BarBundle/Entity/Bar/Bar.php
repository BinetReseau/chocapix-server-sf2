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
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
