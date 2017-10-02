<?php
namespace App\Model\Logic\Tag;

use Cake\ORM\TableRegistry;

class CasterTags
{
    public function __construct ()
    {
        $this->CasterTagsTable = TableRegistry::get('CasterTagsTable');
    }

    public function searchTagByKeyword($keyword)
    {
        $tags = $this->CasterTagsTable->find()
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
    
    public function getAllTag()
    {
        return  $this->CasterTagsTable->find()->all();
    }

    public function createNew($tag_name = null)
    {
        if($tag_name != null)
        {
            $newRecord = $this->CasterTagsTable->newEntity();
            $newRecord->name = $tag_name;
            if($this->CasterTagsTable->save($newRecord))
            {
                return $this->CasterTagsTable->findByName($tag_name)->first();
            }
        }
        
        return false;
    }

    public function edit()
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