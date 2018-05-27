<?php

namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use App\Model\Logic\User\Profile;
use App\Model\Logic\Money\Donate;

class DonateController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Trang thông tin của LiveStreamer'));
        $this->Auth->allow();
    }

    public function index($user_id = null) 
    {
        $ProfileLg = new Profile();

        // $Donates = TableRegistry::get('Donates');
        // $donate =  $Donates->newEntity();

        $TransferMethods = TableRegistry::get('TransferMethods');
        $transferMethods = $TransferMethods->find();
        
        $caster_profile = $ProfileLg->get($user_id);        
        if ($caster_profile->isNew())
        {
            throw new NotFoundException();
        }
        $this->set(compact('caster_profile'));
    }

    public function directDonate($user_id = null)
    {
        if ($this->request->is('put')) 
        {
            $transferMethod =  'NL-AtmCard';
            //Test
            $Donate = new Donate(
                $user_id, 
                $this->request->data('amount'),
                $this->request->data('message'),
                $transferMethod,
                $this->request->data('donater')
            );
            $Donate->do();
            if($Donate->errors)
            {
                foreach($Donate->errors as $error)
                {
                    $this->Flash->error($error);
                }
            }else
            {
                $this->Flash->success(__("Donate thành công"));
            }
        }
        else
        {
            $this->Flash->error(__("Có lỗi xảy ra trong quá trình donate"));
        }
        return $this->redirect(['prefix'=>'front','controller'=>'donate',$user_id]);
    }
}
