<?php
namespace BR\BarBundle\Entity\Client;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Client
{
    /** @ORM\Id @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="decimal") */
    private $money;


    /**
     * Set id
     *
     * @param integer $id
     * @return Client
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Client
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
}
