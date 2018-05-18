<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use App\Model\Logic\Money\Cashflow;

class Donate
{
    protected $DonateData = [
        'from_id' => null,
        'to_id' => null,
        'donater' => null,
        'message' => null,
    ];
    protected $amount = null;
    protected $transferMethodSelector = null;

    public function __construct ($receiver_id, $amount, $message, $transferMethodSelector, $donater = null)
    {
        $this->DonateData['donater'] = $donater;
        $this->DonateData['message'] = $message;
        $this->amount = $amount;
        $this->transferMethodSelector = $transferMethodSelector;
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
        if(isset($this->sendCashflow))
        {
            $sendCashflowResults = $this->sendCashflow->do();
            $this->DonateData['from_id'] = $sendCashflowResults->id;
        }
        $receiveCashflowResults = $this->receiveCashflow->do();
        $this->DonateData['to_id'] = $receiveCashflowResults->id;
        $DonatesTb = TableRegistry::get('donates');
        $donate = $DonatesTb->newEntity($this->DonateData);
        if(!$donate->errors())
        {
            $DonatesTb->save($donate);
        }
        return $donate;
    }
}
?>