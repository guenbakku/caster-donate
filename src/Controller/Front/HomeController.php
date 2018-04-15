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
            'title' => 'test title',
            'content' => 'test content',
            'type_id' => $type_id
        );
        debug($notification);
        $Notification = new Notification();
        $Notification->notify($this->Auth->user('id'),$notification);
        // $Notification->getNotify($this->Auth->user('id'),10);
        
    }
}
