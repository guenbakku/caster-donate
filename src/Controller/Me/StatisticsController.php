<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;

class StatisticsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thống kê'));
    }

    public function index()
    {

    }
}
