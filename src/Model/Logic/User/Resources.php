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
            
        }
        $resources = $resources->andWhere([
            'OR' =>[
                'user_id is' => null,//public
                'user_id =' => $user_id//private
            ]
        ])->order(['user_id'=>'DESC'])->all();

        if ($resources) {
            //convert resource's path
            $resources  = $this->convertResourePath($resources);
        }
        else {
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

    public function uploadNew($user_id, array $new_resource)
    {
        $codeHelper = new CodeHelper(new \Cake\View\View());
        $resource = $this->resourcesTb->newEntity();
        $resource['user_id'] = $user_id;

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

    private function convertResourePath($resources)
    {
        $codeHelper = new CodeHelper(new \Cake\View\View());
        $image_type_id = $codeHelper->setTable('resource_types')->getKey('image','id');
        $audio_type_id = $codeHelper->setTable('resource_types')->getKey('audio','id');
        foreach($resources as $key => $resource)
        {
            if($resource['resource_type_id'] == $image_type_id){
                $resource['filename'] = str_replace('webroot/', '', Configure::read('System.Paths.resource_dir.image').'/'.$resource['filename']);
            }
            //audio
            elseif($resource['resource_type_id'] == $audio_type_id){
                $resource['filename'] = str_replace('webroot/', '', Configure::read('System.Paths.resource_dir.audio').'/'.$resource['filename']);
            }else{
                $path = '';
            }
        }
        
        return $resources;
    }
}
?>