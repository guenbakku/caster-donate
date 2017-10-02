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

    public function kendoGetAll()
    {
        // Trả về tất cả tag đang có trong db
        // Format của dữ liệu trả về tham khảo tại: 
        // http://demos.telerik.com/kendo-ui/multiselect/serverfiltering

       if ($this->request->is("ajax")) 
       {
            $CasterTags = new CasterTags();
            $tags = $CasterTags->getAllTag();

            $count = 0;
            $tagName = [];
            foreach($tags as $tag)
            {
                $tagName[] = [
                    'order_id' => ++$count,
                    'tag_id' => $tag->id,
                    'tag_name' => $tag->name,
                    "Discontinued"=> false
                ];
            }
            $this->response->body(json_encode($tagName));
        }
        return;
    }

    /* public function search($keyword)
    {
        $CasterTags = new CasterTags();
        if ($this->request->is("ajax")) {
            $tags = $CasterTags->searchTagByKeyword($keyword);
            foreach($tags as $tag)
            {
               $tag_name_array[] = $tag->name;
            }
            $this->response->body(json_encode($tag_name_array);
            return;
        }else{
        }
    } */

    public function kendoCreate()
    {
       
        if ($this->request->is("ajax")) 
        {
            //dữ liệu được gửi bằng json qua GET, biến models(array)
            $array = $this->request->query('models');
            $array = json_decode($array);

            $CasterTags = new CasterTags();
            $newRecord = $CasterTags->createNew($array[0]->tag_name);
            if($newRecord)
            {
                $new_tag_id = $newRecord->id;
            }else{
                return;
            }
            $data = array(
                array(
                    "order_id"=> $array[0]->data_current_length + 1, 
                    "tag_id"=> $new_tag_id, 
                    "tag_name"=> $array[0]->tag_name, 
                    "Discontinued"=> false //Cho phép CLient tiếp tục điền thêm tag(false) hoặc overwrite lên tag cũ(true)
                )
            );
            $this->response->body(json_encode($data));            
        }
        return;
    }
}
