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
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'updateSessionAfterUserLogin',
            UsersAuthComponent::EVENT_AFTER_COOKIE_LOGIN => 'updateSessionAfterUserLogin',
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'fillSubTablesAfterUserRegister',
            Configure::read('Events.Controller.Me.AfterEditProfile') => 'updateSessionAfterEditUserProfile',
        ];
    }

    public function updateSessionAfterUserLogin($event)
    {
        $Controller = $event->subject();
        $user = $Controller->Auth->user();
        
        $UserInfos = TableRegistry::get('UserInfos');
        $entity = $UserInfos->findByUserId($user['id'])->first();

        if($entity)
        {
            $user['avatar_url'] = $entity->avatar_url;
            $user['nickname'] = $entity->nickname;
        }
        $Controller->Auth->setUser($user);
    }

    public function fillSubTablesAfterUserRegister($event)
    {
        $Controller = $event->subject();
        $user = $Controller->Auth->user();

        // Insert empty row to user_infos table
        $UserInfos = TableRegistry::get('UserInfos');
        $userInfo = $UserInfos->newEntity();
        $userInfo->user_id = $entity->id;
        $UserInfos->save($userInfo);
    }

    public function updateSessionAfterEditUserProfile($event, $entity)
    {
        $Controller = $event->subject();
        $user = $Controller->Auth->user();

        $user['avatar_url'] = $entity->avatar_url;
        $user['nickname'] = $entity->nickname;
        $Controller->Auth->setUser($user);
    }
}