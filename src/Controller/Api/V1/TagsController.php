<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\Network\Exception\BadRequestException;
use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Tag;

class TagsController extends ApiController
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

        $Tag = new Tag();
        $tags = $Tag->searchByName($q);
        $this->set(compact('tags'));
    }

    /**
     * Trả về tất cả tag của 1 user
     */
    public function getByUserId($user_id)
    {
        $user_id = trim($user_id);

        $Tag = new Tag();
        $tags = $Tag->searchByUserId($user_id);
        $this->set(compact('tags'));
    }
}
