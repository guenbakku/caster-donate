<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Money
{
    function __construct() {
        $this->$profilesTb = TableRegistry::get('Profiles');
    }

    public function getCurrentBalance($user_id)
    {

    }

    public function donate($donateDatas = [])
    {
        //1)kiểm tra        
        //2)thực hiện cộng trừ tiền
        if($donateDatas['donate_method_selector'] == 'coin')// trường hợp Donate Coin
        {
            $this->decrease($donateDatas['sender_id'], $donateDatas['amount']);
        }
        $this->increase($donateDatas['receiver_id'], $donateDatas['amount']);
        
        //3)ghi lại log vào bảng donates           
        //4)Gửi thông báo đến 2 bên
        //5)trả kết quả
        return true;
    }

    public function increase($user_id, $amount)
    {
        $profile = $this->$profilesTb->findByUserId($user_id)->first();

        if($profile)
        {
            if($amount > 0)
            {
                if($profile->balance == null) $profile->balance = 0;
                debug($amount);
                $profile->balance += $amount;
            }
            $this->$profilesTb->save($profile);
        }
        return $profile;
    }

    public function decrease($user_id, $amount)
    {
        $profile = $this->$profilesTb->findByUserId($user_id)->first();
        if($profile)
        {
            if($amount > 0)
            {
                if($profile->balance == null) $profile->balance = 0;
                $profile->balance -= $amount;
            }
            $this->$profilesTb->save($profile);
        }
        return;
    }

    public function withdrawal($user_id, $amount, $bank_id)
    {

    }

    public function charge($user_id, $amount)
    {

    }
}

?>