<?php

namespace App\Model\Logic\Admin;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Hash;

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
            'Contracts' => [
                'ContractStatuses',
            ],
        ]);

        // Don't get unactive users
        $query->where(function ($exp, $q) {
            return $exp->isNotNull('activation_date');
        });

        // Build query based on conditions
        $val = trim(Hash::get($conditions, 'username', ''));
        if ($val !== '') {
            $query->where(function ($exp, $q) use ($val) {
                return $exp->like('Users.username', '%'.$val.'%');
            });
        }

        $val = trim(Hash::get($conditions, 'email', ''));
        if ($val !== '') {
            $query->where(function ($exp, $q) use ($val) {
                return $exp->like('Users.email', '%'.$val.'%');
            });
        }

        $val = Hash::get($conditions, 'status_id', '');
        if ($val !== '') {
            $query->where(['Contracts.status_id' => $val]);
        }

        return $query;
    }
}