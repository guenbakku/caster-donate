<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Collection\Collection;
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

    /**
     * Trả về tất cả tag có tên trùng với string gửi lên từ client
     * Format của dữ liệu trả về tham khảo tại: 
     * https://select2.org/data-sources/formats
     */
    public function get()
    {
        if ($this->request->is("ajax")) 
        {
            $q = $this->request->getQuery('q');
            
            if (empty($q) && $q !== '0') {
                $this->response->body(json_encode([]));
                return $this->response;
            }

            $CasterTags = new CasterTags();
            $tags = $CasterTags->searchByName($q);

            $collection = new Collection($tags);
            $collection = $collection->map(function ($val, $key) {
                return [
                    'id' => $val->id,
                    'text' => $val->name,
                ];
            });
            $result = $collection->toArray();

            $this->response->body(json_encode($result));
            return $this->response;
        }
    }

    public function add()
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
