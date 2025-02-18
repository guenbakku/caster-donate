<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Collection\Collection;
use App\Controller\AppController;
use App\Model\Logic\User\Tag;

class TagsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thể loại live stream yêu thích'));
    }

    public function edit()
    {   
        if ($this->request->is('put')) {
            $TagLg = new Tag();
            $user_id = $this->Auth->user('id');
            $caster_tags = $this->request->data('caster_tags') ?: [];
            $TagLg->save($user_id, $caster_tags);
    
            $this->Flash->success(__('Thay đổi thể loại live stream thành công.'));
        }
    }
}
