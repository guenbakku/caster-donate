<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class UpdateUserListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'updateLoginSession',
            UsersAuthComponent::EVENT_AFTER_COOKIE_LOGIN => 'updateLoginSession',
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'fillSubTablesAfterUserRegister',
            Configure::read('Events.App_AfterEditProfile') => 'updateLoginSession',
        ];
    }

    public function fillSubTablesAfterUserRegister($event)
    {
        $Controller = $event->getSubject();
        $user = $Controller->Auth->user();
        
        // Insert empty row to profiles table
        $profilesTb = TableRegistry::get('Profiles');
        $profile = $profilesTb->newEntity([
            'user_id' => $event->getData('user')->id,
        ]);
        $profilesTb->save($profile);
    }

    public function updateLoginSession($event)
    {
        $Controller = $event->getSubject();
        $user = $Controller->Auth->user();
        
        if ($user) {
            $profilesTb = TableRegistry::get('Profiles');
            $entity = $profilesTb->findByUserId($user['id'])
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