<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Network\Exception\ForbiddenException;
use App\Controller\AppController;
use App\Form\Me\Contract\TermAgreeForm;
use App\Model\Logic\User\Contract;

class ContractController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Hợp đồng'));
        $this->ChainAction->setConfig('steps', [
            'CreateContract' => ['term', 'register', 'confirmRegister'],
            'EditContract' => ['edit', 'confirmEdit'],
        ]);
    }

    public function term()
    {
        if ($this->Me->get('contract')->is('unregistered') === false) {
            throw new ForbiddenException;
        }

        $this->ContentHeader->title(__('Đăng ký hợp đồng .:. Điều khoản'));
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(function () {
            $termAgree = new TermAgreeForm;
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                if ($termAgree->execute($data)) {
                    $this->ChainAction->completeStep($data);
                    return $this->redirect(['action' => 'register']);
                } else {
                    $errors = Hash::flatten($termAgree->errors());
                    $this->Flash->error(implode("\n", $errors));
                }
            } elseif ($this->request->is('get')) {
                // Set kết quả từ session vào form khi quay lại từ những step sau
                $data = $this->ChainAction->getStepData();
                if ($data !== null) {
                    $this->RequestDataPatcher->patch($data);
                }
            }
            $stepNo = $this->ChainAction->getStepNo();
            $this->set(compact('termAgree', 'stepNo'));
        });
    }

    public function register()
    {
        $this->ContentHeader->title(__('Đăng ký hợp đồng .:. Nhập thông tin'));
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(function () {
            $contract = null;
            if ($this->request->is('post')) {
                $ContractLg = new Contract();
                $data = $this->request->getData();
                $contract = $ContractLg->validate($data);
                if (empty($contract->errors())) {
                    $drafted = $ContractLg->draft($data);
                    $this->ChainAction->completeStep($drafted);
                    return $this->redirect(['action' => 'confirmRegister']);
                } else {
                    $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
                }
            } elseif ($this->request->is('get')) {
                // Set kết quả từ session vào form khi quay lại từ những step sau
                $data = $this->ChainAction->getStepData();
                if ($data !== null) {
                    $this->RequestDataPatcher->patch($data);
                }
            }
            $stepNo = $this->ChainAction->getStepNo();
            $this->set(compact('contract', 'stepNo'));
        });
    }

    public function confirmRegister()
    {
        $this->ContentHeader->title(__('Đăng ký hợp đồng .:. Kiểm tra'));
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(function () {
            $contract = $this->ChainAction->getStepData('register');
            if ($this->request->is('post')) {
                $user_id = $this->Me->get('id');
                $ContractLg = new Contract();
                $contract = $ContractLg->create($user_id, $contract);

                $this->dispatchEvent(
                    Configure::read('Events.App_AfterCreateContract'), 
                    ['contract' => $contract]
                );

                $this->ChainAction->clear();
                $this->Flash->success(__('Đăng ký hợp đồng thành công'));
                return $this->redirect(['action' => 'view']);
            }
            $stepNo = $this->ChainAction->getStepNo();
            $backAction = 'register';
            $this->set(compact('contract', 'stepNo', 'backAction'));
        });
    }

    public function edit()
    {
        if (!$this->Me->get('contract')->is('inadequacy')) {
            throw new ForbiddenException;
        }

        $this->ContentHeader->title(__('Chỉnh sửa hợp đồng .:. Nhập thông tin'));
        $this->ChainAction->setConfig(['process' => 'EditContract']);
        $this->ChainAction->beginStep(function () {
            $contract = null;
            if ($this->request->is('post')) {
                $ContractLg = new Contract();
                $data = $this->request->getData();
                $contract = $ContractLg->validate($data);
                if (empty($contract->errors())) {
                    $drafted = $ContractLg->draft($data);
                    $this->ChainAction->completeStep($drafted);
                    return $this->redirect(['action' => 'confirmEdit']);
                } else {
                    $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
                }
            } elseif ($this->request->is('get')) {
                // Set kết quả từ session vào form khi quay lại từ những step sau
                $data = $this->Me->get('contract')->toArray();
                if ($data !== null) {
                    $this->RequestDataPatcher->patch($data);
                }
            }
            $stepNo = $this->ChainAction->getStepNo();
            $this->set(compact('contract', 'stepNo'));
        });
    }

    public function confirmEdit()
    {
        $this->ContentHeader->title(__('Chỉnh sửa hợp đồng .:. Kiểm tra'));
        $this->ChainAction->setConfig(['process' => 'EditContract']);
        $this->ChainAction->beginStep(function () {
            $contract = $this->ChainAction->getStepData('edit');
            if ($this->request->is('post')) {
                $user_id = $this->Me->get('id');
                $ContractLg = new Contract();
                $contract = $ContractLg->edit($user_id, $contract);

                $this->ChainAction->clear();
                $this->Flash->success(__('Chỉnh sửa hợp đồng thành công'));
                return $this->redirect(['action' => 'view']);
            }
            $stepNo = $this->ChainAction->getStepNo();
            $backAction = 'edit';
            $this->set(compact('contract', 'stepNo', 'backAction'));
        });
    }

    public function view() 
    {
        if ($this->Me->get('contract')->is('unregistered')) {
            return $this->redirect(['action' => 'term']); 
        }

        $contract = $this->Me->get('contract');
        $this->set(compact('contract'));
    }
}
