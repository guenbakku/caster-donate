<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use App\Model\Logic\User\Profile;

class UpdateUser implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'updateUserInfoSession',
            UsersAuthComponent::EVENT_AFTER_COOKIE_LOGIN => 'updateUserInfoSession',
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'fillSubTablesAfterUserRegister',
            Configure::read('Events.Controller.Me.AfterEditProfile') => 'updateUserInfoSession',
            Configure::read('Events.Controller.Me.AfterEditTag') => 'updateUserInfoSession',
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

        // Insert empty row to caster_infos table
        $CasterInfos = TableRegistry::get('CasterInfos');
        $casterInfo = $CasterInfos->newEntity([
            'user_id' => $event->getData('user')->id,
            'donate_link' => $event->getData('user')->username,
        ]);
        $CasterInfos->save($casterInfo);
    }

    public function updateUserInfoSession($event)
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