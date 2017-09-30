<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\Profile\Profile;
use App\Model\Logic\Tag\Tag;

class AjaxListenerController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->autoRender = false;
        $this->response->charset('UTF-8');
        $this->response->type('json');
    }

    public function index()
    {
    }

    public function AutoCompleteTag($keyword)
    {
        $Tag = new Tag();
        if ($this->request->is("ajax")) {
            $tags = $Tag->searchTagByKeyword($keyword);
            foreach($tags as $tag)
            {
               $tag_name_array[] = $tag->name;
            }
            $this->set(compact('tag_name_array'));
            $this->set('_serialize', ['tag_name_array']);
            echo json_encode(compact('tags', 'tag_name_array'));
            return;
        }else{
        }
    }
}
