<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Collection\Collection;
use App\Controller\AppController;
use App\Model\Logic\Profile\Tag;

class TagsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->eventManager()->off($this->Csrf);
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
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
        if ($this->request->is("ajax")) {
            $q = $this->request->getQuery('q');
            $q = trim($q);
            
            if (empty($q) && $q !== '0') {
                $this->response->body(json_encode([]));
                return $this->response;
            }

            $Tag = new Tag();
            $tags = $Tag->searchByName($q);

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
}
