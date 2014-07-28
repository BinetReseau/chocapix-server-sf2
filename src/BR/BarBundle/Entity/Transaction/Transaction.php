<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Transaction\TransactionRepository")
 * @ORM\Table(name="tr_All")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap(
 *      {"appro" = "ApproTransaction",
 *      "buy" = "BuyTransaction",
 *      "give" = "GiveTransaction",
 *      "throw" = "ThrowTransaction",
 *      "punish" = "PunishTransaction"})
 *
 * @JMS\ExclusionPolicy("none")
 */
abstract class Transaction
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Bar\Bar")
     * @JMS\Exclude
     */
    protected $bar;

    /**
     * @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Auth\User")
     */
    protected $author;

    /** @ORM\Column(type="datetime") */
    protected $timestamp;

    /** @ORM\OneToMany(targetEntity="BR\BarBundle\Entity\Operation\Operation", mappedBy="transaction", cascade={"persist", "remove"}, orphanRemoval=true) */
    protected $operations;

    /** @ORM\Column(type="decimal", precision=7, scale=3) */
    protected $moneyflow;

    /** @ORM\Column(type="boolean") */
    protected $canceled;


    public function __construct($bar, $author)
    {
        $this->bar = $bar;
        $this->author = $author;
        $this->timestamp = new \DateTime("now");
        $this->operations = new ArrayCollection();
        $this->moneyflow = 0;
        $this->canceled = false;
    }

    abstract public function checkIntegrity();


    /**
     * @JMS\SerializedName("bar")
     * @JMS\VirtualProperty
     */
    public function getBarId() {
        return $this->bar->getId();
    }


    public function addOperation(\BR\BarBundle\Entity\Operation\Operation $operation) {
        $this->operations[] = $operation;
        return $this;
    }

    public function removeOperation(\BR\BarBundle\Entity\Operation\Operation $operation) {
        $this->operations->removeElement($operation);
    }

    public function getOperations() {
        return $this->operations;
    }


    public function getId() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
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

    /**
     * Set moneyflow
     *
     * @param string $moneyflow
     * @return Transaction
     */
    public function setMoneyflow($moneyflow)
    {
        $this->moneyflow = $moneyflow;

        return $this;
    }

    /**
     * Get moneyflow
     *
     * @return string 
     */
    public function getMoneyflow()
    {
        return $this->moneyflow;
    }

    /**
     * Get canceled
     *
     * @return boolean 
     */
    public function getCanceled()
    {
        return $this->canceled;
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
     * Set author
     *
     * @param \BR\BarBundle\Entity\Auth\User $author
     * @return Transaction
     */
    public function setAuthor(\BR\BarBundle\Entity\Auth\User $author = null)
    {
        $this->author = $author;

        return $this;
    }
}
