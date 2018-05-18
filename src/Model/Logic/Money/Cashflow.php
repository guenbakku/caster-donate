<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use App\Model\Logic\Money\Wallet;
use App\View\Helper\CodeHelper;

class Cashflow 
{
    protected $CashflowData = [
        'wallet_id' => null,
        'amount' => null,
        'cashflow_type_id' => null,
        'transfer_method_id' => null,
    ];
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
        $this->CashflowData['wallet_id'] = $this->wallet->getId();
    }

    public function setAmount(int $amount)
    {
        $this->CashflowData['amount'] = $amount;
    }

    public function setCashflowType(string $cashflowTypeSelector)
    {
        $this->cashflowTypeSelector = $cashflowTypeSelector;
        $this->CashflowData['cashflow_type_id'] = $this->codeHelper->setTable('cashflow_types')->getKey( $cashflowTypeSelector, 'id');
    }

    public function setTransferMethod(string $transferMethodSelector)
    {
        $this->CashflowData['transfer_method_id'] = $this->codeHelper->setTable('transfer_methods')->getKey( $transferMethodSelector, 'id');
    }

    public function do()
    {
        $CashflowsTb = TableRegistry::get('cashflows');
        $cashflow = $CashflowsTb->newEntity($this->CashflowData);
        if(!$cashflow->errors())
        {
            $CashflowsTb->save($cashflow);
            switch ($this->cashflowTypeSelector)
            {
                case 'Withdraw': 
                case 'SendDonate': $this->wallet->decrease($this->CashflowData['amount']);break;
                case 'Deposit':
                case 'ReceiveDonate': $this->wallet->increase($this->CashflowData['amount']);break;
            }
        }
        return $cashflow;
    }
}
?>