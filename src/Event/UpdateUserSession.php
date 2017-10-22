<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use App\Model\Logic\User\Profile;

class UpdateUserSession implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'updateUserInfo',
            UsersAuthComponent::EVENT_AFTER_COOKIE_LOGIN => 'updateUserInfo',
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'fillSubTablesAfterUserRegister',
            Configure::read('Events.Controller.Me.AfterEditProfile') => 'updateUserInfo',
            Configure::read('Events.Controller.Me.AfterEditTag') => 'updateUserInfo',
        ];
    }

    public function fillSubTablesAfterUserRegister($event)
    {
        $Controller = $event->getSubject();
        $user = $Controller->Auth->user();
        
        // Insert empty row to user_infos table
        $UserInfos = TableRegistry::get('UserInfos');
        $userInfo = $UserInfos->newEntity([
            'user_id' => $event->getData('user')->id,
        ]);
        $UserInfos->save($userInfo);
    }

    public function updateUserInfo($event)
    {
        $Controller = $event->getSubject();
        $user = $Controller->Auth->user();
        
        if ($user) {
            $UserInfos = TableRegistry::get('UserInfos');
            $entity = $UserInfos->findByUserId($user['id'])
                ->contain([])
                ->first();
            
            $user['profile'] = [
                'avatar_url' => $entity->avatar_url,
                'nickname' => $entity->nickname,
                'birthday' => $entity->birthday,
                'location' => $entity->location,
            ];
            $Controller->Auth->setUser($user);
        }
    }
}