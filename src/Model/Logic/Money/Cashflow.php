<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use App\View\Helper\CodeHelper;
use App\Model\Logic\Money\Wallet;


/**
   * Cashflow
   * 
   */
class Cashflow extends Wallet
{
    public $cashflow_id;
    public $amount;
    public $cashflow_type_id;
    public $transfer_method_id;

    /**
       * 
       * Khởi tạo dòng tiền
       *
       * @param uuid $user_id   Đối tượng của dòng tiền
       * @param int $amount     Số tiền
       * @param int $cashflowTypeSelector     Id thể loại dòng tiền, dựa vào Id này để cộng hay trừ trong ví
       * @param int $transferMethodSelector   Id của phương thức dòng tiền
       */
    public function __construct($user_id, $amount, $cashflowTypeSelector, $transferMethodSelector) {
        parent::__construct($user_id);
        $this->codeHelper = new CodeHelper(new \Cake\View\View());
        $this->setAmount($amount);
        $this->setCashflowType($cashflowTypeSelector);
        $this->setTransferMethod($transferMethodSelector);
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setCashflowType(string $cashflowTypeSelector)
    {
        $this->cashflowTypeSelector = $cashflowTypeSelector;
        $this->cashflow_type_id = $this->codeHelper->setTable('cashflow_types')->getKey( $cashflowTypeSelector, 'id');
    }

    public function setTransferMethod(string $transferMethodSelector)
    {
        $this->transfer_method_id = $this->codeHelper->setTable('transfer_methods')->getKey( $transferMethodSelector, 'id');
    }

    public function do()
    {
        $CashflowsTb = TableRegistry::get('cashflows');
        $cashflow = $CashflowsTb->newEntity([
            'wallet_id' => $this->wallet_id,
            'amount' => $this->amount,
            'cashflow_type_id' => $this->cashflow_type_id,
            'transfer_method_id' => $this->transfer_method_id,
        ]);
        if(!$cashflow->errors())
        {
            $cashflow = $CashflowsTb->save($cashflow);
            $this->cashflow_id = $cashflow->id;
            switch ($this->cashflowTypeSelector)
            {
                case 'Withdraw': 
                case 'SendDonate': $this->decrease($this->amount); break;
                case 'Deposit':
                case 'ReceiveDonate': $this->increase($this->amount); break;
            }
        }else
        {
            //Lưu thông điệp lỗi
            foreach($cashflow->errors() as $error)
            {
                foreach($error as $reason => $message)
                {
                    $this->errors[] = $message;
                }
            }
        }
    }
}
?>