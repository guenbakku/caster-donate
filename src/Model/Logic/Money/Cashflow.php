<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use App\Model\Logic\Money\Wallet;
use App\View\Helper\CodeHelper;

class Cashflow 
{
    protected $wallet_id = null;
    protected $amount = null;
    protected $cashflow_type_id = null;
    protected $transfer_method_id = null;

    protected $cashflowTypeSelector = null;
    protected $transferMethodSelector = null;
    protected $wallet = null;

    public function __construct($user_id, $amount, $cashflowTypeSelector, $transferMethodSelector) {
        $this->codeHelper = new CodeHelper(new \Cake\View\View());
        $this->setWallet($user_id);
        $this->setAmount($amount);
        $this->setCashflowType($cashflowTypeSelector);
        $this->setTransferMethod($transferMethodSelector);
    }

    public function setWallet($user_id)
    {
        $this->wallet = new Wallet($user_id);
        $this->wallet_id = $this->wallet->getId();
    }

    public function setAmount(int $amount)
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
            $CashflowsTb->save($cashflow);
            switch ($this->cashflowTypeSelector)
            {
                case 'Withdraw': 
                case 'SendDonate': $this->wallet->decrease($this->amount); break;
                case 'Deposit':
                case 'ReceiveDonate': $this->wallet->increase($this->amount); break;
            }
        }
        return $cashflow;
    }
}
?>