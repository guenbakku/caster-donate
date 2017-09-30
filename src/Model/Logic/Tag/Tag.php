<?php
namespace App\Model\Logic\Tag;

use Cake\ORM\TableRegistry;

class Tag
{
    public function __construct ()
    {
        $this->CasterTags = TableRegistry::get('CasterTags');
    }

    public function searchTagByKeyword($keyword)
    {
        $tags = $this->CasterTags->find()
                ->where(['CasterTags.name LIKE' => '%'.$keyword.'%'])
                ->all();
        
        return $tags;    
    }

    public function getTagRelatedWithUser($user_id)
    {

    }
    
    public function deleteTagRelatedWithUser($user_id, $tag_id)
    {

    }

    public function addTagRelatedWithUser($user_id, $tag_id)
    {

    }
    
    public function delete($tag_id)
    {
        
    }   

    public function add($tag_name)
    {

    }
}
?>