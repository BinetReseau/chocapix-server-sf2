<?php
namespace BR\BarBundle\Entity\Client;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Friend
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Client") */
    private $client1;
    /** @ORM\ManyToOne(targetEntity="Client") */
    private $client2;

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
     * Set client1
     *
     * @param \BR\BarBundle\Entity\Client\Client $client1
     * @return Friend
     */
    public function setClient1(\BR\BarBundle\Entity\Client\Client $client1 = null)
    {
        $this->client1 = $client1;

        return $this;
    }

    /**
     * Get client1
     *
     * @return \BR\BarBundle\Entity\Client\Client
     */
    public function getClient1()
    {
        return $this->client1;
    }

    /**
     * Set client2
     *
     * @param \BR\BarBundle\Entity\Client\Client $client2
     * @return Friend
     */
    public function setClient2(\BR\BarBundle\Entity\Client\Client $client2 = null)
    {
        $this->client2 = $client2;

        return $this;
    }

    /**
     * Get client2
     *
     * @return \BR\BarBundle\Entity\Client\Client
     */
    public function getClient2()
    {
        return $this->client2;
    }
}
