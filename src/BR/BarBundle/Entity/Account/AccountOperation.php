<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\Operation;

/** @ORM\Entity */
class AccountOperation extends Operation
{
    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account;

    /** @ORM\Column(type="decimal", precision=7, scale=3) */
    private $deltamoney;

    /** @ORM\Column(type="decimal", precision=8, scale=3) */
    private $newmoney;


    public function __construct($transaction, $account, $deltamoney)
    {
        parent::__construct($transaction);
        $this->account = $account;
        $this->deltamoney = $deltamoney;
        $this->newmoney = $account->getMoney();
    }
}
