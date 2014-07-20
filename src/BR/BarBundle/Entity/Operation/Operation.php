<?php
namespace BR\BarBundle\Entity\Operation;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="op_All")
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

    /** @ORM\ManyToOne(targetEntity="BR\BarBundle\Entity\Transaction\Transaction", inversedBy="operations") */
    private $transaction;


    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }


    public function getTransaction() {
        return $this->transaction;
    }
}
