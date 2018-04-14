<?php
namespace App\Model\Logic\User;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Validation\Validation;

class Notification
{
    public function __construct ()
    {
        $this->UserNotifications = TableRegistry::get('UserNotifications');
    }

    
}
?>