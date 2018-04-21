<?php
namespace App\Controller\Api\V1;

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

        $TagLg = new Tag();
        $tags = $TagLg->searchByName($q);
        $this->set(compact('tags'));
    }

    /**
     * Trả về tất cả tag của 1 user
     */
    public function getByUserId($user_id)
    {
        $user_id = trim($user_id);

        $TagLg = new Tag();
        $tags = $TagLg->searchByUserId($user_id);
        $this->set(compact('tags'));
    }
}
