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

    /**
     * Set id
     *
     * @param integer $id
     * @return Friend
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set relationcount
     *
     * @param integer $relationcount
     * @return Friend
     */
    public function setRelationcount($relationcount)
    {
        $this->relationcount = $relationcount;

        return $this;
    }

    /**
     * Get relationcount
     *
     * @return integer 
     */
    public function getRelationcount()
    {
        return $this->relationcount;
    }

    /**
     * Set user1
     *
     * @param \BR\BarBundle\Entity\User\User $user1
     * @return Friend
     */
    public function setUser1(\BR\BarBundle\Entity\User\User $user1 = null)
    {
        $this->user1 = $user1;

        return $this;
    }

    /**
     * Get user1
     *
     * @return \BR\BarBundle\Entity\User\User 
     */
    public function getUser1()
    {
        return $this->user1;
    }

    /**
     * Set user2
     *
     * @param \BR\BarBundle\Entity\User\User $user2
     * @return Friend
     */
    public function setUser2(\BR\BarBundle\Entity\User\User $user2 = null)
    {
        $this->user2 = $user2;

        return $this;
    }

    /**
     * Get user2
     *
     * @return \BR\BarBundle\Entity\User\User 
     */
    public function getUser2()
    {
        return $this->user2;
    }
}
