<?php

namespace App\Model\Logic\Admin;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class Accounts 
{
    public function __construct()
    {
        $this->usersTb = TableRegistry::get('Users');
    }

    /**
     * Return query object based on search conditions
     *
     * @param   array: condition
     * @return  Query
     */
    public function search(array $conditions)
    {
        $query = $this->usersTb->find();
        $query->contain([
            'Profiles',
            'Contracts',
        ]);

        return $query;
    }
}