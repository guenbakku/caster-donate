<?php
namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

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
    }
}
