<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Tag;

class SchedulesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Lịch lên sóng'));
    }

    public function index()
    {

    }

    public function add() 
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
