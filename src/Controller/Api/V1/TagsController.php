<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\Profile\Profile;
use App\Model\Logic\Tag\Tag;

class TagsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->eventManager()->off($this->Csrf);
        $this->autoRender = false;
        $this->viewBuilder()->layout('ajax');
        $this->response->charset('UTF-8');
        $this->response->type('json');
    }

    public function index()
    {
        // Trả về tất cả tag đang có trong db
        // Format của dữ liệu trả về tham khảo tại: 
        // http://demos.telerik.com/kendo-ui/multiselect/serverfiltering
    }

    public function search($keyword)
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
