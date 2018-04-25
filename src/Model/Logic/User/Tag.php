<?php
namespace App\Model\Logic\User;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Validation\Validation;
use Cake\Utility\Hash;

class Tag
{
    public function __construct ()
    {
        $this->CasterTagsTb = TableRegistry::get('CasterTags');
        $this->UsersCasterTagsTb = TableRegistry::get('UsersCasterTags');
    }
    /**
     * Lấy thông tin tất cả các tag hiện có
     */
    public function getAll()
    {
        $tags = $this->CasterTagsTb->find('all')->all();
        return $tags;
    }

    /**
     * Tìm kiếm tag theo tên tag
     *
     * @param   string
     * @return  array
     */
    public function searchByName(string $keyword)
    {
        $tags = $this->CasterTagsTb->find()
            ->where(['CasterTags.name LIKE' => '%'.$keyword.'%'])
            ->group('CasterTags.name') // Select unique tag name
            ->all();
        
        return $tags;    
    }

    /**
     * Tìm kiếm tag theo user_id
     *
     * @param   string
     * @return  array
     */
    public function searchByUserId(string $user_id)
    {
        $tags = $this->UsersCasterTagsTb->find()
            ->where(['UsersCasterTags.user_id' => $user_id])
            ->contain(['CasterTags'])
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
            
            $this->UsersCasterTagsTb->deleteAll(['user_id' => $user_id]);

            $classified = $this->classify($tags);
            $new_ids = $this->createNewTags($classified['new']);
            
            $save_data = array_merge($classified['old'], $new_ids?:[]);
            if ($save_data) {
                $save_data = Hash::insert($save_data, '{n}.user_id', $user_id);
            }

            $entities = $this->UsersCasterTagsTb->newEntities($save_data);
            $result = $this->UsersCasterTagsTb->saveMany($entities);

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
        $entities = $this->CasterTagsTb->newEntities($tags);
        $result = $this->CasterTagsTb->saveMany($entities);
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
                $exists = $this->CasterTagsTb->exists(['id' => $tag]);
                if ($exists) {
                    $classified['old'][] = ['caster_tag_id' => $tag];
                }
                continue;
            }

            $exists = $this->CasterTagsTb->findByName($tag)->first();
            if ($exists) {
                $classified['old'][] = ['caster_tag_id' => $exists->id];
                continue;
            }

            $classified['new'][] = ['name' => $tag];
        }
        
        return $classified;
    }
}
?>