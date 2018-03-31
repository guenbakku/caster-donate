<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;

class ContractController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Hợp đồng'));
    }

    public function term()
    {
        
    }

    public function sign()
    {

    }

    public function view() 
    {
        if (!$this->Me->get('isCaster')) {
            $this->redirect(['action' => 'term']); 
        }
    }
}
