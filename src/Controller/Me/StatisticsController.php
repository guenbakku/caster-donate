<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Tag;

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
