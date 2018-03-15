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

    public function get($user_id)
    {
        $resources = $this->resourcesTb->find()
        ->where(['user_id is' => null])
        ->orwhere(['user_id =' => $user_id])
        ->all();

        if ($resources) {
            //
        }
        else {
            $resources = $this->resourcesTb->newEntity();
        }
        return $resources;
    }

    public function uploadNew($user_id, array $new_resource)
    {
        $codeHelper = new CodeHelper(new \Cake\View\View());
        $resource = $this->resourcesTb->newEntity();

        //image
        if($new_resource['resource_type_id'] == $codeHelper->setTable('resource_types')->getKey('image','id')){
            $path = Configure::read('System.Paths.resource_dir.image');
            $validate = 'image';
        }
        //audio
        elseif($new_resource['resource_type_id'] == $codeHelper->setTable('resource_types')->getKey('audio','id')){
            $path = Configure::read('System.Paths.resource_dir.audio');
            $validate = 'audio';
        }

        $this->resourcesTb->patchEntity($resource, $new_resource,[
            'validate' => $validate,
        ]);

        if(!$resource->errors()) {
            //UploadBehavior config
            if ($this->resourcesTb->behaviors()->has('Upload')) {
                $this->resourcesTb->behaviors()->get('Upload')->config([
                    'filename' => [
                        'path' => $path,
                    ],
                ]);
            }

            $this->resourcesTb->save($resource,['validate' => false]);
        }

        return $resource;
    }
}
?>