<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Wallet
{
    public function __construct($user_id) {
        $this->WalletsTb = TableRegistry::get('Wallets');
        $this->wallet = $this->WalletsTb->findByUserId($user_id)->first();
        if (!$this->wallet)
        {
            $entity = $this->WalletsTb->newEntity([
                'user_id' => $user_id,
                'balance' => 0
            ]);
            $this->wallet = $this->WalletsTb->save($entity);
        }
    }

    public function getBalance()
    {
        return $this->wallet->balance;
    }

    public function getId()
    {
        return $this->wallet->id;
    }

    public function increase($amount)
    {
        if(is_numeric($amount) && $amount > 0)
        {
            $this->wallet->balance += $amount;
        }
        $this->WalletsTb->save($this->wallet);
    }

    public function decrease($amount)
    {
        if(is_numeric($amount) && $amount > 0)
        {
            if ($this->wallet->balance >= $amount) $this->wallet->balance -= $amount;
            else
            {
                //
                //
                //
                //
                //  Xử lý lỗi
                //
                //
                //
            }
        }
        $this->$WalletsTb->save($this->wallet);
    }

}

?>