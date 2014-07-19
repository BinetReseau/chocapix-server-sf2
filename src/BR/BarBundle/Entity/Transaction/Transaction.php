<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;

 // * @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Operation\TransactionRepository")

/**
 * @ORM\Entity
 * @ORM\Table(name="tr_All")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
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
     * @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Bar\Bar")
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

    /** @ORM\OneToMany(targetEntity="BR\BarBundle\Entity\Operation\Operation", mappedBy="transaction", cascade={"persist", "remove"}, orphanRemoval=true) */
    private $operations;


    public function __construct($bar)
    {
        $this->bar = $bar;
        $this->timestamp = new \DateTime("now");
        $this->operations = new ArrayCollection();
    }


    public function addOperation(\BR\BarBundle\Entity\Operation\Operation $operations) {
        $this->operations[] = $operations;
        return $this;
    }

    public function removeOperation(\BR\BarBundle\Entity\Operation\Operation $operations) {
        $this->operations->removeElement($operations);
    }
}
