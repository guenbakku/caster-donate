<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Utility\Text;

class Contract
{
    public function __construct()
    {
        $this->contractsTb = TableRegistry::get('Contracts');
    }

    /**
     * Trả về thông tin hợp đồng
     *
     * @param   string
     * @return  Entity
     */
    public function get($contract_id)
    {
        $entity = $this->contractsTb->findById($contract_id)
            ->contain(['BankAccounts', 'Sexes'])
            ->first();

        return $entity;
    }

    /**
     * Validate input từ form
     *
     * @param   array
     * @return  Entity
     */
    public function validate(array $contract)
    {
        $entity = $this->contractsTb->newEntity($contract, [
            'associated' => ['BankAccounts'],
        ]);

        return $entity;
    }

    /**
     * Lưu tạm thông tin hợp đồng (dùng cho màn hình confirm).
     * NOTICE: Method này không validate input.
     *
     * @param   array
     * @return  array
     */
    public function draft(array $contract)
    {
        $tmp_front = TMP.Text::uuid();
        $tmp_back = TMP.Text::uuid();

        $moved_front = move_uploaded_file($contract['identify_card_front']['tmp_name'], $tmp_front);
        $moved_back = move_uploaded_file($contract['identify_card_back']['tmp_name'], $tmp_back);

        if ($moved_front === false || $moved_back === false) {
            throw new \RuntimeException('Could not move uploaded file');
        }

        $contract['identify_card_front']['tmp_name'] = $tmp_front;
        $contract['identify_card_back']['tmp_name'] = $tmp_back;

        return $contract;
    }

    /**
     * Tạo mới hợp đồng
     * NOTICE: Method này không validate input
     *
     * @param   string
     * @param   array
     * @return  Entity
     */
    public function create($user_id, $contract)
    {   
        $contract['user_id'] = $user_id;
        $entity = $this->contractsTb->newEntity($contract, [
            'validate' => false,
            'associated' => ['BankAccounts'],
        ]);

        $this->contractsTb->save($entity);
        return $entity;
    }
}
?>