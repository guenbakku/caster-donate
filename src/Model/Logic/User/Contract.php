<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class Contract
{
    public function __construct()
    {
        $this->contractsTb = TableRegistry::get('Contracts');
    }

    public function validate($contract)
    {
        $entity = $this->contractsTb->newEntity($contract, [
            'associated' => [
                'BankAccounts',
            ]
        ]);

        return $entity;
    }

    public function create($contract)
    {

    }
}
?>