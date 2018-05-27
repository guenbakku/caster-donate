<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use App\Model\Logic\Money\Cashflow;

class Donate
{
    
    /**
    *   @property array $errors
    *   - Lưu trữ lỗi xảy ra trong quá trình thực hiện theo dạng [ 0 => 'message1', '1' => 'message2' ......]
    *   - Bên ngoài có thể xác định có lỗi hay không thông qua property này  if(!errors)...
    */
    public $errors = [];

    public $from_id;
    public $to_id;
    public $donater;
    public $message;
    public $transferMethodSelector;

    protected $amount;

    public function __construct ($receiver_id, $amount, $message, $transferMethodSelector, $donater = null)
    {
        $this->amount = $amount;
        $this->message = $message;
        $this->transferMethodSelector = $transferMethodSelector;
        $this->donater = $donater;

        $this->setReceiver($receiver_id);
    }

    // Thiết lập người gửi (nếu cần)
    public function setSender($user_id)
    {
        $this->sendCashflow = new Cashflow($user_id, $this->amount, 'SendDonate', $this->transferMethodSelector);
    }

    //Thiết lập người nhận
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
                $this->sendCashflow->do();
                if($this->sendCashflow->errors)
                {
                    $this->errors = $this->sendCashflow->errors;
                    return false;
                }
                $this->from_id = $this->sendCashflow->cashflow_id;
            }

            //Lưu dòng tiền được nhận
            $this->receiveCashflow->do();
            if($this->receiveCashflow->errors)
            {
                $this->errors = $this->receiveCashflow->errors;
                return false;
            }
            $this->to_id = $this->receiveCashflow->cashflow_id;

            //Lưu record Donate
            $donate = $DonatesTb->newEntity([
                'from_id' => $this->from_id,
                'to_id' => $this->to_id,
                'donater' => $this->donater,
                'message' => $this->message,
            ]);

            if(!$donate->errors())
            {
                $DonatesTb->save($donate);
                return true;
            }else
            {
                foreach($donate->errors() as $error)
                {
                    foreach($error as $reason => $message)
                    {
                        $this->errors[] = $message;
                    }
                }
                return false;
            }
        };
        
        //Thực hiện lưu Donate, rollback nếu lỗi xảy ra
        $conn = $DonatesTb->getConnection();
        return $conn->transactional($saveProcess);
    }
    
}
?>