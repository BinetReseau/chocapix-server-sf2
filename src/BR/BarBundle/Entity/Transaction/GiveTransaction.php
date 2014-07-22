<?php
namespace BR\BarBundle\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

use BR\BarBundle\Entity\Operation\AccountOperation;

/**
 * @ORM\Entity
 * @ORM\Table(name="tr_Give")
 */
class GiveTransaction extends Transaction
{
    public function checkIntegrity() {
    	$moneyin = 0;
    	$moneyout = 0;

    	foreach ($this->operations as $op) {
    		if($op instanceof AccountOperation) {
    			if($op->getMoneyFlow() > 0)
    				$moneyin += $op->getMoneyFlow();
    			else
    				$moneyout += $op->getMoneyFlow();
    		}
    		else
    			return false;
    	}

    	if($moneyin == -$moneyout) {
	    	$this->moneyflow = $moneyin;
	    	return true;
    	}
    	else
    		return false;
    }
}
