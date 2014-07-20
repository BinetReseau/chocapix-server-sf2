<?php
namespace BR\BarBundle\Entity\Operation;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;

 // * @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Operation\TransactionRepository")

/**
 * @ORM\Entity
 * @JMS\ExclusionPolicy("none")
 */
class Transaction
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Bar\Bar")
     * @JMS\Exclude
     */
    private $bar;
    /**
     * @JMS\SerializedName("bar")
     * @JMS\VirtualProperty
     */
    public function getBarId()
    {
        return $this->bar->getId();
    }


    /** @ORM\Column(type="datetime") */
    private $timestamp;

    /** @ORM\Column(type="string") */
    private $type;


    /** @ORM\OneToMany(targetEntity="Operation", mappedBy="transaction", cascade={"persist", "remove"}, orphanRemoval=true) */
    private $operations;


    public function __construct($bar, $type)
    {
        $this->bar = $bar;
        $this->type = $type;
        $this->timestamp = new \DateTime("now");
        $this->operations = new ArrayCollection();
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
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Transaction
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Transaction
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set bar
     *
     * @param \BR\BarBundle\Entity\Bar\Bar $bar
     * @return Transaction
     */
    public function setBar(\BR\BarBundle\Entity\Bar\Bar $bar = null)
    {
        $this->bar = $bar;

        return $this;
    }

    /**
     * Get bar
     *
     * @return \BR\BarBundle\Entity\Bar\Bar 
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * Add operations
     *
     * @param \BR\BarBundle\Entity\Operation\Operation $operations
     * @return Transaction
     */
    public function addOperation(\BR\BarBundle\Entity\Operation\Operation $operations)
    {
        $this->operations[] = $operations;

        return $this;
    }

    /**
     * Remove operations
     *
     * @param \BR\BarBundle\Entity\Operation\Operation $operations
     */
    public function removeOperation(\BR\BarBundle\Entity\Operation\Operation $operations)
    {
        $this->operations->removeElement($operations);
    }

    /**
     * Get operations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOperations()
    {
        return $this->operations;
    }
}
