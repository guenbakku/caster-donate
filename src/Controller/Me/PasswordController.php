<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Tag;

class PasswordController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Mật khẩu'));
    }

    public function edit()
    {

    }
}
