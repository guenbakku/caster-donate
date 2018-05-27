<?php
namespace App\Controller\Api\V1;

use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Search;
use Cake\Event\Event;

class SearchController extends ApiController
{
    /**
     * Trả về tất cả tag chứa keyword gửi lên từ client
     * Format của dữ liệu trả về tham khảo tại: 
     * https://select2.org/data-sources/formats
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    public function getByName()
    {
        $q = $this->request->getQuery('q');
        $q = trim($q);

        $SearchLg = new Search();
        $SearchResult = $SearchLg->searchAll($q);
        $this->set(compact('SearchResult'));
    }
}
