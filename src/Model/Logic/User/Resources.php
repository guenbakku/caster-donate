<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;
use App\View\Helper\CodeHelper;

class Resources
{
    public function __construct()
    {
        $this->resourcesTb = TableRegistry::get('resources');
    }

    public function getAllAvailableResources($user_id, $type = '')
    {
        $codeHelper = new CodeHelper(new \Cake\View\View());
        $type_id = $codeHelper->setTable('resource_types')->getKey($type,'id');
        
        $resources = $this->resourcesTb->find();
        
        if($type_id != null)
        {
            $resources->where(["resource_type_id" => $type_id]);
        }
        $resources = $resources->andWhere([
            'OR' =>[
                'user_id is' => null,//public
                'user_id =' => $user_id//private
            ]
        ])->order(['user_id'=>'DESC'])
        ->order(['modified' => 'DESC'])
        ->all();

        if (empty($resources)) {
            $resources = $this->resourcesTb->newEntity();
        }

        return $resources;
    }

    public function getAllPrivateResources($user_id, $type = '')
    {
       
    }

    public function getAllPublicResources()
    {
       
    }

    public function addPrivateResource($user_id, array $new_resource)
    {
        $new_resource   =   array_merge($new_resource, [
            'name' => $new_resource['filename']['name'],
            'user_id' => $user_id,
        ]);
        $codeHelper = new CodeHelper(new \Cake\View\View());
        $uploadSettings = [];

        if ($new_resource['resource_type_id'] == $codeHelper->setTable('resource_types')->getKey('image', 'id')) {
            $uploadSettings = [
                'filename' => [
                    'path' => Configure::read('System.Paths.resource_dir.image'),
                    'resizeTo' => [300, 300],
                    'resizeKeepRatio' => true
                ]
            ];
            $validate = 'image';
        } elseif ($new_resource['resource_type_id'] == $codeHelper->setTable('resource_types')->getKey('audio', 'id')) {
            $uploadSettings = [
                'filename' => [
                    'path' => Configure::read('System.Paths.resource_dir.audio'),
                    'transformer' => null,
                ]
            ];
            $validate = 'audio';
        }
        
        $resource = $this->resourcesTb->newEntity();
        $this->resourcesTb->patchEntity($resource, $new_resource,[
            'validate' => $validate,
        ]);
        
        if (!$resource->errors()) {
            $this->resourcesTb->behaviors()->get('Upload')->config($uploadSettings);
            $conn = $this->resourcesTb->getConnection();
            $conn->transactional(function () use ($uploadSettings, $resource) {
                // Delete old record
                $oldResource = $this->resourcesTb->find()
                    ->where(['user_id' => $resource['user_id']])
                    ->where(['resource_type_id' => $resource['resource_type_id']])
                    ->where(['resource_feature_id' => $resource['resource_feature_id']])
                    ->contain([])
                    ->first();
                if (!empty($oldResource)) {
                    $this->resourcesTb->delete($oldResource);
                }

                // Add new record
                $this->resourcesTb->save($resource, ['validate' => false]);
            });
        }

        return $resource;
    }
}
?>