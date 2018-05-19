<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use App\Model\Logic\Money\Cashflow;

class Donate
{

    protected $from_id = null;
    protected $to_id = null;
    protected $donater = null;
    protected $message = null;

    protected $amount = null;
    protected $transferMethodSelector = null;

    public function __construct ($receiver_id, $amount, $message, $transferMethodSelector, $donater = null)
    {
        $this->amount = $amount;
        $this->message = $message;
        $this->transferMethodSelector = $transferMethodSelector;
        $this->donater = $donater;

        $this->setReceiver($receiver_id);
    }

    public function setSender($user_id)
    {
        $this->sendCashflow = new Cashflow($user_id, $this->amount, 'SendDonate', $this->transferMethodSelector);
    }

    public function setReceiver($user_id)
    {  
        $this->receiveCashflow = new Cashflow($user_id, $this->amount, 'ReceiveDonate', $this->transferMethodSelector);
    }

    public function do()
    {
        $DonatesTb = TableRegistry::get('donates');

        //Khai báo xử lý lưu Donate
        $saveProcess = function() use($DonatesTb)
        {
            //Lưu dòng tiền cho đi (nếu có)
            if(isset($this->sendCashflow))
            {
                $sendCashflowResults = $this->sendCashflow->do();
                $this->from_id = $sendCashflowResults->id;
            }
            //Lưu dòng tiền được nhận
            $receiveCashflowResults = $this->receiveCashflow->do();
            $this->to_id = $receiveCashflowResults->id;
            //Lưu Log
            $donate = $DonatesTb->newEntity([
                'from_id' => $this->from_id,
                // 'to_id' => $this->to_id,
                'to_id' => null,
                'donater' => $this->donater,
                'message' => $this->message,
            ]);
            if(!$donate->errors())
            {
                $DonatesTb->save($donate);
                return true;
            }else
            {
                debug($donate->errors());
                return false;
            }
        };
        
        //Thực hiện lưu Donate, rollback nếu lỗi xảy ra
        $conn = $DonatesTb->getConnection();
        return $conn->transactional($saveProcess);
        
    }
    
}
?>