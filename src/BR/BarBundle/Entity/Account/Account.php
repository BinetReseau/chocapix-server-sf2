<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/** @ORM\Entity(repositoryClass="BR\BarBundle\Entity\Account\AccountRepository") */
class Account
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
     * @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Auth\User", inversedBy="accounts")
     * @JMS\Exclude
     */
    private $user;

    /** @ORM\Column(type="decimal", precision=9, scale=3) */
    private $money;


    /**
     * @JMS\SerializedName("bar")
     * @JMS\VirtualProperty
     */
    public function getBarId()
    {
        return $this->bar->getId();
    }

    /**
     * @JMS\SerializedName("user")
     * @JMS\VirtualProperty
     */
    public function getUserId()
    {
        return $this->user->getId();
    }

    public function operation($transaction, $deltamoney)
    {
        $this->money += $deltamoney;
        $op = new AccountOperation($transaction, $this, $deltamoney);
        $transaction->addOperation($op);
        return $op;
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
     * Get money
     *
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
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
