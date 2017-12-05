<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\Network\Exception\BadRequestException;
use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Search;

class SearchController extends ApiController
{
    /**
     * Trả về tất cả tag chứa keyword gửi lên từ client
     * Format của dữ liệu trả về tham khảo tại: 
     * https://select2.org/data-sources/formats
     */
    public function getByName()
    {
        $q = $this->request->getQuery('q');
        $q = trim($q);

        $Search = new Search();
        $SearchResult = $Search->searchAll($q);
        $this->set(compact('SearchResult'));
    }
}
