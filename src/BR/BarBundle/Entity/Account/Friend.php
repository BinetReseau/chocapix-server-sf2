<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use BR\BarBundle\Command\Types\Annotations\GenerateType;

 // * @GenerateType("friend", gen_type=true, gen_typeid=true)
/**
 * @ORM\Entity
 */
class Friend
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account1;
    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account2;

    /** @ORM\Column(type="integer") */
    private $relationcount;

}
