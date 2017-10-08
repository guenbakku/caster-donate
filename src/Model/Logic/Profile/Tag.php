<?php
namespace App\Model\Logic\Profile;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Validation\Validation;
use Cake\Utility\Hash;

class Tag
{
    public function __construct ()
    {
        $this->CasterTags = TableRegistry::get('CasterTags');
        $this->UsersCasterTags = TableRegistry::get('UsersCasterTags');
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
     * Lưu tag của user
     *
     * @param   string: user id
     * @param   array: tag muốn lưu
     * @return  bool
     */
    public function save($user_id, array $tags)
    {
        $conn = ConnectionManager::get('default');
        try 
        {
            $conn->begin();
            
            $this->UsersCasterTags->deleteAll(['user_id' => $user_id]);

            $classified = $this->classify($tags);
            $new_ids = $this->createNewTags($classified['new']);
            
            $save_data = array_merge($classified['old'], $new_ids?:[]);
            if ($save_data) {
                $save_data = Hash::insert($save_data, '{n}.user_id', $user_id);
            }
            
            $entities = $this->UsersCasterTags->newEntities($save_data);
            $result = $this->UsersCasterTags->saveMany($entities);

            $conn->commit();
            return $result;
        }
        catch (Exception $e)
        {
            $conn->rollback();
            throw $e;
        }
    }

    /**
     * Thêm tag mới chưa có vào bảng caster_tags
     *
     * @param   array
     * @return  array: created tags' ids
     */
    public function createNewTags(array $tags)
    {   
        $entities = $this->CasterTags->newEntities($tags);
        $result = $this->CasterTags->saveMany($entities);
        if (!$result) {
            return false;
        }

        // Extract only ids
        $collection = new Collection($result);
        $created = $collection->map(function ($val, $key) {
            return ['caster_tag_id' => $val->id];
        })->toArray();

        return $created;
    }

    /**
     * Phân loại tag được truyền lên từ form
     * Nếu là tag mới, thêm vào table caster_tags trước rồi 
     * thêm id tag vào danh sách.
     *  [
     *      'new' => ['tag_names'],
     *      'old' => ['tag_ids'],
     *  ]
     */
    public function classify(array $tags)
    {   
        $classified = [
            'new' => [],
            'old' => [],
        ];
        foreach ($tags as $tag) {
            if (Validation::uuid($tag)) {
                $classified['old'][] = ['caster_tag_id' => $tag];
                continue;
            }

            $exists = $this->CasterTags->findByName($tag)->first();
            if ($exists) {
                $classified['old'][] = ['caster_tag_id' => $exists->id];
                continue;
            }

            $classified['new'][] = ['name' => $tag];
        }
        
        return $classified;
    }

    public function getTagsRelatedWithUser($user_id)
    {

    }
}
?>