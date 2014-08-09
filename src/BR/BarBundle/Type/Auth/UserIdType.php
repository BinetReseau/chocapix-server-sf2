<?php
namespace BR\BarBundle\Type\Auth;

use Doctrine\Common\Persistence\ObjectManager;
use BR\BarBundle\Type\IdTypeBase;

class UserIdType extends IdTypeBase
{
    public function __construct(ObjectManager $om) {
        parent::__construct($om, 'BR\BarBundle\Entity\Auth\User', 'user');
    }

    public function getName() {
        return 'user_id';
    }

}
