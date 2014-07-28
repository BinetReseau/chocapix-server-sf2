<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\AccountOperation;

/**
 * @ORM\Entity
 * @ORM\Table(name="tr_Punish")
 */
class PunishTransaction extends Transaction
{
    /**
     * @ORM\Column(type="text")
     */
    protected $motive;

    public function checkIntegrity() {
    	$moneyin = 0;
    	$moneyout = 0;

    	foreach ($this->operations as $op) {
    		if($op instanceof AccountOperation) {
    			if($op->getMoneyFlow() < 0)
    				return true;
    		}
    		else
    			return false;
    	}
    }

    public function getMotive() {
        return $this->motive;
    }

    public function setMotive($motive) {
        $this->motive = $motive;
        return $this;
    }
}
