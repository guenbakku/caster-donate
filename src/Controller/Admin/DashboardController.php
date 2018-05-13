<?php
namespace App\Controller\Admin;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use App\Controller\Admin\BaseController;

class DashboardController extends BaseController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thống kê'));
    }

    public function index() {

    }
}
