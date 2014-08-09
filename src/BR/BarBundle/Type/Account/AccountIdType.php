<?php
namespace BR\BarBundle\Type\Account;

use Doctrine\Common\Persistence\ObjectManager;
use BR\BarBundle\Type\IdTypeBase;

class AccountIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BR\BarBundle\Entity\Account\Account', 'account');
    }

    public function getName() {
        return 'account_id';
    }

}
