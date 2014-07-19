<?php
namespace BR\BarBundle\Entity\Operation;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
class Operation
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Operation\Transaction", inversedBy="operations") */
    private $transaction;


    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
}
