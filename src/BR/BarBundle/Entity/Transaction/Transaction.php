<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

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
 * @GenerateType("transaction")
 */
abstract class Transaction
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Bar\Bar") */
    protected $bar;

    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Auth\User") */
    protected $author;

    /** @ORM\Column(type="datetime") */
    protected $timestamp;

    /** @ORM\Column(type="decimal", precision=7, scale=3) */
    protected $moneyflow;

    /** @ORM\Column(type="boolean") */
    protected $canceled;


    public function __construct($bar, $author)
    {
        $this->bar = $bar;
        $this->author = $author;
        $this->timestamp = new \DateTime("now");
        $this->moneyflow = 0;
        $this->canceled = false;
    }

    abstract public function checkIntegrity();


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

    public function setMoneyflow($moneyflow) {
        $this->moneyflow = $moneyflow;
        return $this;
    }

    public function getMoneyflow() {
        return $this->moneyflow;
    }

    public function getCanceled() {
        return $this->canceled;
    }

    public function setBar(\BR\BarBundle\Entity\Bar\Bar $bar = null) {
        $this->bar = $bar;
        return $this;
    }

    public function getBar() {
        return $this->bar;
    }

    public function setAuthor(\BR\BarBundle\Entity\Auth\User $author = null) {
        $this->author = $author;
        return $this;
    }
}
