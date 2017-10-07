<?php
namespace App\Model\Logic\Tag;

use Cake\ORM\TableRegistry;

class CasterTags
{
    public function __construct ()
    {
        $this->CasterTags = TableRegistry::get('CasterTags');
    }

    /**
     * Tìm kiếm tag theo tên
     *
     * @param   string
     * @return  array
     */
    public function searchByName(string $keyword)
    {
        $keyword = trim($keyword);
        $tags = $this->CasterTags->find()
                ->where(['CasterTags.name LIKE' => '%'.$keyword.'%'])
                ->group('CasterTags.name') // Select unique tag name
                ->all();
        
        return $tags;    
    }

    /**
     * Thêm tag mới chưa có vào bảng caster_tags
     *
     * @param   array
     * @return  bool
     */
    public function insert(array $tags)
    {
        if($tag_name != null)
        {
            $newRecord = $this->CasterTags->newEntity();
            $newRecord->name = $tag_name;
            if($this->CasterTags->save($newRecord))
            {
                return $this->CasterTags->findByName($tag_name)->first();
            }
        }
        
        return false;
    }

    public function getTagRelatedWithUser($user_id)
    {

    }
    
    public function deleteTagRelatedWithUser($user_id, $caster_tag_id)
    {

    }

    public function addTagRelatedWithUser($user_id, $caster_tag_id)
    {

    }
}
?>