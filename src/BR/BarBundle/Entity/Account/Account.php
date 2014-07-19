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
     * @JMS\SerializedName("bar")
     * @JMS\VirtualProperty
     */
    public function getBarId()
    {
        return $this->bar->getId();
    }


    /**
     * @ORM\ManyToOne(targetEntity="\BR\BarBundle\Entity\Auth\User", inversedBy="accounts")
     * @JMS\MaxDepth(2)
     */
    private $user;

    /** @ORM\Column(type="decimal", precision=9, scale=3) */
    private $money;


    public function operation($transaction, $deltamoney)
    {
        $this->money += $deltamoney;
        $op = new AccountOperation($transaction, $this, $deltamoney);
        $transaction->addOperation($op);
        return $op;
    }

    public function getMoney() {
        return $this->money;
    }
}
