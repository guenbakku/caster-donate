<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;
use App\Controller\AppController;
use App\Form\Me\Contract\TermAgreeForm;
use App\Model\Logic\User\Contract;

class ContractController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ChainAction');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Hợp đồng'));
    }

    public function term()
    {
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(0, function () {
            $termAgree = new TermAgreeForm;
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                if ($termAgree->execute($data)) {
                    $this->ChainAction->complete($data);
                    return $this->redirect(['action' => 'create']);
                } else {
                    $errors = Hash::flatten($termAgree->errors());
                    $this->Flash->error(implode("\n", $errors));
                }
            } elseif ($this->request->is('get')) {
                // Set kết quả từ session vào form khi quay lại từ những step sau
                $data = $this->ChainAction->getStepData();
                if ($data !== null) {
                    $data = Hash::get($data, 'results');
                    $this->RequestDataPatcher->patch($data);
                }
            }
            $this->set(compact('termAgree'));
        });
    }

    public function create()
    {
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(1, function () {
            $contract = null;
            if ($this->request->is('post')) {
                $Contract = new Contract();
                $data = $this->request->getData();
                $contract = $Contract->validate($data);
                if (empty($contract->errors())) {
                    $drafted = $Contract->draft($data);
                    $this->ChainAction->complete($drafted);
                    return $this->redirect(['action' => 'confirm']);
                } else {
                    $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
                }
            }
            $this->set(compact('contract'));
        });
    }

    public function confirm()
    {
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(2, function () {
            
        });
    }

    public function view() 
    {
        if (!$this->Me->get('isCaster')) {
            return $this->redirect(['action' => 'term']); 
        }
    }
}
