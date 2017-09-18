<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class MeController extends AppController
{
    public function index() {
        $this->ContentHeader->title('Trang cá nhân');
        $user_id = $this->Auth->user('id');
    }
}
