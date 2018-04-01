<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;
use App\Controller\AppController;
use App\Form\Me\Contract\TermAgreeForm;

class ContractController extends AppController
{
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
            }
        });
    }

    public function create()
    {
        $this->ChainAction->setConfig(['process' => 'CreateContract']);
        $this->ChainAction->beginStep(1, function () {

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
