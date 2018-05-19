<?php
namespace App\Model\Logic\Money;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Wallet
{
    /**
    *   @property array $errors
    *   - Lưu trữ lỗi xảy ra trong quá trình thực hiện theo dạng [ 0 => 'message1', '1' => 'message2' ......]
    *   - Bên ngoài có thể xác định có lỗi hay không thông qua property này  if(!errors)...
    */
    public $errors = []; 

    protected $wallet_id;
    protected $user_id;
    protected $balance;

    private $entity;

    /**
       * 
       * Khởi tạo ví
       *
       * @param uuid $user_id 
       */
    public function __construct($user_id) {
        $this->WalletsTb = TableRegistry::get('Wallets');
        $this->entity = $this->WalletsTb->findByUserId($user_id)->first();
        if (!$this->entity)
        {
            $this->entity = $this->WalletsTb->newEntity([
                'user_id' => $user_id,
                'balance' => 0
            ]);
            $this->entity = $this->WalletsTb->save($this->entity);
        }
        $this->wallet_id = $this->entity->id;
        $this->user_id = $this->entity->user_id;
        $this->balance = $this->entity->balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getWalletId()
    {
        return $this->wallet_id;
    }

    public function increase($amount)
    {
        if(is_numeric($amount) && $amount > 0)
        {
            $this->balance += $amount;
        }
        $this->save();
    }

    public function decrease($amount)
    {
        if(is_numeric($amount) && $amount > 0)
        {
            $this->wallet->balance -= $amount;
        }
        $this->save();
    }

    private function save()
    {
        $data = [
            'id' => $this->wallet_id,
            'user_id' => $this->user_id,
            'balance' => $this->balance,
        ];
        $entity = $this->WalletsTb->patchEntity($this->entity,$data);
        if(!$entity->errors())
        {
            $this->WalletsTb->save($entity);
        }else
        {
            foreach($entity->errors() as $error)
            {
                foreach($error as $reason => $message)
                {
                    $this->errors[] = $message;
                }
            }
            $entity;
        }
    }

}

?>