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
        $list = ['bank_card', 'identify_card_front', 'identify_card_back'];
        foreach ($list as $item) {
            $dest = TMP.Text::uuid();
            $src =& $contract[$item]['tmp_name'];
            $result = move_uploaded_file($src, $dest);
            if ($result === false) {
                throw new \RuntimeException(
                    sprintf('Could not move uploaded file from %s to %s', $src, $dest)
                );
            }
            $src = $dest;
        }

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