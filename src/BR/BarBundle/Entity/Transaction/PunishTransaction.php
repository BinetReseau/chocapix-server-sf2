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
    	$moneyout = 0;

    	foreach ($this->operations as $op) {
    		if($op instanceof AccountOperation) {
    			if($op->getMoneyFlow() < 0)
                    $moneyout += $op->getMoneyFlow();
                else
                    return false;
    		}
    		else
    			return false;
    	}

        $this->moneyflow = -$moneyout;
        return true;
    }

    public function getMotive() {
        return $this->motive;
    }

    public function setMotive($motive) {
        $this->motive = $motive;
        return $this;
    }
}
