<?php
namespace BR\BarBundle\Type\Account;

use BR\BarBundle\Type\IdTypeBase;
use Doctrine\Common\Persistence\ObjectManager;

class AccountIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BRBarBundle:Account\Account', 'account');
    }

    public function getName() {
        return 'account_id';
    }
}
