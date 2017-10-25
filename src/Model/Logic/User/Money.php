<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Money
{
    function __construct() {
        $this->userInfos = TableRegistry::get('UserInfos');
    }

    public function getCurrentBalance($user_id)
    {

    }

    public function donate($donateDatas = [])
    {
        //1)kiểm tra        
        //2)thực hiện cộng trừ tiền
        if(1)// trường hợp Donate Coin
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
        $userInfo = $this->userInfos->findByUserId($user_id)->first();

        if($userInfo)
        {
            if($amount > 0)
            {
                if($userInfo->balance == null) $userInfo->balance = 0;
                debug($amount);
                $userInfo->balance += $amount;
            }
            $this->userInfos->save($userInfo);
        }
        return $userInfo;
    }

    public function decrease($user_id, $amount)
    {
        $userInfo = $this->userInfos->findByUserId($user_id)->first();
        if($userInfo)
        {
            if($amount > 0)
            {
                if($userInfo->balance == null) $userInfo->balance = 0;
                $userInfo->balance -= $amount;
            }
            $this->userInfos->save($userInfo);
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