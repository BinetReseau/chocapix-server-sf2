<?php
namespace BR\BarBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Friend
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account1;
    /** @ORM\ManyToOne(targetEntity="Account") */
    private $account2;

    /** @ORM\Column(type="integer") */
    private $relationcount;

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
     * Set relationcount
     *
     * @param integer $relationcount
     * @return Friend
     */
    public function setRelationcount($relationcount)
    {
        $this->relationcount = $relationcount;

        return $this;
    }

    /**
     * Get relationcount
     *
     * @return integer 
     */
    public function getRelationcount()
    {
        return $this->relationcount;
    }

    /**
     * Set account1
     *
     * @param \BR\BarBundle\Entity\Account\Account $account1
     * @return Friend
     */
    public function setAccount1(\BR\BarBundle\Entity\Account\Account $account1 = null)
    {
        $this->account1 = $account1;

        return $this;
    }

    /**
     * Get account1
     *
     * @return \BR\BarBundle\Entity\Account\Account 
     */
    public function getAccount1()
    {
        return $this->account1;
    }

    /**
     * Set account2
     *
     * @param \BR\BarBundle\Entity\Account\Account $account2
     * @return Friend
     */
    public function setAccount2(\BR\BarBundle\Entity\Account\Account $account2 = null)
    {
        $this->account2 = $account2;

        return $this;
    }

    /**
     * Get account2
     *
     * @return \BR\BarBundle\Entity\Account\Account 
     */
    public function getAccount2()
    {
        return $this->account2;
    }
}
