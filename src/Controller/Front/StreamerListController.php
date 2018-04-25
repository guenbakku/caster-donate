<?php
namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class StreamerListController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // $this->ContentHeader->title(__('Danh sách Streamer'));
        $this->Auth->allow();
    }

    public function index() {

    }
}
