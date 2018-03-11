<?php
namespace App\Model\Logic\User;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Utility\Flysystem;

class Resources
{
    public function __construct()
    {
        $this->usersResourcesTb = TableRegistry::get('users_resources');
        $this->resourcesTb = TableRegistry::get('resources');
    }

    public function get($user_id)
    {
        $usersResources = $this->usersResourcesTb->find()
        ->where(['OR' =>['user_id =' => $user_id, 'user_id =' => null]])
        ->all();

        if ($usersResources) {
            // $UsersSocialProvidersTb = TableRegistry::get('UsersSocialProviders');
            // $profile->social_providers = $UsersSocialProvidersTb->repleteEntities($profile->social_providers);
        }
        else {
            $usersResources = $this->usersResourcesTb->newEntity();
        }
        return $usersResources;
    }

    public function uploadNew($user_id, array $new_resource)
    {
        $userResource = $this->usersResourcesTb->newEntity();
        $userResource->user_id = $user_id;
        
        $resource = $this->resourcesTb->newEntity();
        $resource->user_id = $user_id;

        $this->usersResourcesTb->patchEntity($resource, $new_resource, [
            'associated' => [
                'ResourceTypes._joinData' => ['validate' => 'default'],
            ],
        ]);

        if(!$resource->errors()) {
            $this->resourcesTb->save($resource);
            $userResource->resource_id = $resource->id;
        }

        // return $profile;
    }
}
?>