<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\Tag\CasterTags;

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
        return;
    }

    public function getAll()
    {
        // Trả về tất cả tag đang có trong db
        // Format của dữ liệu trả về tham khảo tại: 
        // http://demos.telerik.com/kendo-ui/multiselect/serverfiltering

       if ($this->request->is("ajax")) 
       {
            $CasterTags = new CasterTags();
            $tags = $CasterTags->getAllTag();

            $tagArray = [];
            foreach($tags as $tag)
            {
                $tagArray[] = [
                    'number' => preg_replace('/[^0-9]/', '', $tag->id),
                    'tag_id' => $tag->id,
                    'name' => $tag->name,
                    "Discontinued"=> false
                ];
            }
            $this->response->body(json_encode($tagArray));
        }
        return;
    }

    public function create()
    {   
        if ($this->request->is("ajax")) 
        {
            //dữ liệu được gửi bằng json qua GET, biến models(array)
            $array = $this->request->query('models');
            $array = json_decode($array);

            $CasterTags = new CasterTags();
            $newRecord = $CasterTags->add($array[0]->name);
            if (!$newRecord) {
                return;
            }

            $data = [
                [
                    "id" => $newRecord->id, 
                    "name" =>$newRecord->name, 
                    "Discontinued" => false //Cho phép CLient tiếp tục điền thêm tag(false) hoặc overwrite lên tag cũ(true)
                ]
            ];
            $this->response->body(json_encode($data));            
        }
        return;
    }
}
