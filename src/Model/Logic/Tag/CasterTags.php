<?php
namespace App\Model\Logic\Tag;

use Cake\ORM\TableRegistry;

class CasterTags
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
    
    public function deleteTagRelatedWithUser($user_id, $caster_tag_id)
    {

    }

    public function addTagRelatedWithUser($user_id, $caster_tag_id)
    {

    }
    
    public function getAllTag()
    {
        return  $this->CasterTags  
                        ->find()
                        ->order(['name' => 'ASC'])
                        ->order(['id' => 'ASC'])
                        ->all();
    }

    public function createNew($tag_name = null)
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

    public function edit()
    {

    }

    public function delete($caster_tag_id)
    {
        
    }   

    public function add($caster_tag_name)
    {

    }

}
?>