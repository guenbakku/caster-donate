<?php
namespace App\Controller\Admin;

use App\Controller\Admin\BaseController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

class DashboardController extends BaseController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thống kê'));
    }

    public function index() {
        $this->Flash->error('Hello');
        $this->Flash->info('Hello');
        $this->Flash->success('Hello');
    }
}
