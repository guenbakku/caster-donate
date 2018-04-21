<?php
namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
//gọi để test >>>
use App\Model\Logic\User\Notification;
use App\View\Helper\CodeHelper;

class HomeController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    public function index() {
        // $this->Flash->success('Nội dung flash');
        // $this->Flash->error('Nội dung flash');
        // $this->Flash->warning('Nội dung flash');
        // $this->Flash->info('Nội dung flash');

        // TEST >>>>>>>>>>>>
        $codeHelper = new CodeHelper(new \Cake\View\View());
        $type_id = $codeHelper->setTable('notification_types')->getKey('admin','id');        
        $notification = array (
            'user_id' => 'fd72778c-294d-4239-89c4-5d64fc9946a5',
            'template_id' => '00000000-0000-0000-0000-000000000002',
            'extend_id' => '',
            'vars' => '{}'
        );
        $Notification = new Notification();
        // $Notification->seenAll($this->Auth->user('id'));
        // $Notification->notify($notification);
        // $Notification->getNotify($this->Auth->user('id'),10);
        
    }
}
