<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\AccountOperation;

/** @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Account\AccountRepository") */
class Account
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


    /**
     * @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Auth\User", inversedBy="accounts")
     * @JMS\MaxDepth(2)
     */
    private $user;

    /** @ORM\Column(type="decimal", precision=9, scale=3) */
    private $money;


    public function operation($transaction, $deltamoney)
    {
        $op = new AccountOperation($transaction, $this, $deltamoney);
        $transaction->addOperation($op);
        $this->money += $deltamoney;
        return $op;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setMoney($money) {
        $this->money = $money;
        return $this;
    }

    public function getMoney() {
        return $this->money;
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
     * Set money
     *
     * @param string $money
     * @return Account
     */
    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

    /**
     * Set bar
     *
     * @param \BR\BarBundle\Entity\Bar\Bar $bar
     * @return Account
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
     * Set user
     *
     * @param \BR\BarBundle\Entity\Auth\User $user
     * @return Account
     */
    public function setUser(\BR\BarBundle\Entity\Auth\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BR\BarBundle\Entity\Auth\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
