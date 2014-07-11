<?php
namespace BR\BarBundle\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity */
class Role implements RoleInterface
{
    /** @ORM\Id @ORM\Column(type="string", length=50) */
    private $id;

    /** @ORM\Column(type="string", length=50) */
    private $name;


    public function getRole()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Role
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

    /**
     * Set name
     *
     * @param string $name
     * @return Role
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
