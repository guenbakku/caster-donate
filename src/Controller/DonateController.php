<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use App\Model\Logic\User\Profile;

class DonateController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Trang Donate của Caster'));
        $this->Auth->allow();
    }

    public function index($user_id = null) 
    {
        $Profile = new Profile();

        $profile = $Profile->get($user_id);        
        if($profile->isNew())
        {
            $this->render('usernotfound');
            return;
        }
        
        $this->set(compact('profile'));
    }
}
