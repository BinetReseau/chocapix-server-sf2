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
}
