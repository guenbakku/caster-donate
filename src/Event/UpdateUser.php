<?php
namespace App\Event;

use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\AuthComponent;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use App\Model\Logic\Profile\Profile;

class UpdateUser implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'updateUserSession',
            UsersAuthComponent::EVENT_AFTER_COOKIE_LOGIN => 'updateUserSession',
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'fillSubTablesAfterUserRegister',
            Configure::read('Events.Controller.Me.AfterEditProfile') => 'updateUserSession',
        ];
    }

    public function fillSubTablesAfterUserRegister($event)
    {
        $Controller = $event->subject();
        $user = $Controller->Auth->user();
        
        // Insert empty row to user_infos table
        $UserInfos = TableRegistry::get('UserInfos');
        $userInfo = $UserInfos->newEntity([
            'user_id' => $event->getData('user')->id,
        ]);
        $UserInfos->save($userInfo);
    }

    public function updateUserSession($event)
    {
        $Controller = $event->subject();
        $user = $Controller->Auth->user();
        
        if ($user) {
            $UserInfos = TableRegistry::get('UserInfos');
            $entity = $UserInfos->findByUserId($user['id'])
                ->contain(['CasterTags'])
                ->first();
            
            $user['profile'] = [
                'avatar_url' => $entity->avatar_url,
                'nickname' => $entity->nickname,
                'birthday' => $entity->birthday,
                'location' => $entity->location,
                'caster_tags' => $entity->caster_tags,
            ];
            $Controller->Auth->setUser($user);
        }
    }
}