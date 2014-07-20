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
 * @ORM\DiscriminatorMap({"buy" = "BuyTransaction"})
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

    /** @ORM\Column(type="datetime") */
    private $timestamp;

    /** @ORM\OneToMany(targetEntity="BR\BarBundle\Entity\Operation\Operation", mappedBy="transaction", cascade={"persist", "remove"}, orphanRemoval=true) */
    private $operations;

    /** @ORM\Column(type="boolean") */
    private $canceled;


    public function __construct($bar)
    {
        $this->bar = $bar;
        $this->timestamp = new \DateTime("now");
        $this->canceled = false;
        $this->operations = new ArrayCollection();
    }

    /**
     * @JMS\SerializedName("bar")
     * @JMS\VirtualProperty
     */
    public function getBarId()
    {
        return $this->bar->getId();
    }


    public function addOperation(\BR\BarBundle\Entity\Operation\Operation $operations) {
        $this->operations[] = $operations;
        return $this;
    }

    public function removeOperation(\BR\BarBundle\Entity\Operation\Operation $operations) {
        $this->operations->removeElement($operations);
    }

    public function getOperations() {
        return $this->operations;
    }


    public function getId() {
        return $this->id;
    }


    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setCanceled($canceled) {
        $this->canceled = $canceled;
        return $this;
    }

    public function isCanceled() {
        return $this->canceled;
    }
}
