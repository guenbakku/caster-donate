<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class UpdateLoginSessionListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            'Auth.afterIdentify' => 'injectProfileToLoginSession',
            Configure::read('Events.App_AfterEditProfile') => 'updateProfileInLoginSession',
            Configure::read('Events.App_AfterEditEmail') => 'updateUserInLoginSession',
        ];
    }

    public function injectProfileToLoginSession($event) { 
        $user = $event->getData(0);
        $user['profile'] = $this->_getUserProfile($user['id']);
        $event->setResult($user);
    }

    public function updateProfileInLoginSession($event)
    {
        $Controller = $event->getSubject();
        $user = $Controller->Auth->user();
        
        if ($user) {           
            $user['profile'] = $this->_getUserProfile($user['id']);
            $Controller->Auth->setUser($user);
        }
    }

    public function updateUserInLoginSession($event)
    {
        $Controller = $event->getSubject();
        $user = $Controller->Auth->user();
        
        if ($user) {
            $usersTb = TableRegistry::get('Users');
            $entity = $usersTb->findById($user['id'])
                ->contain([])
                ->first();
            
            $user = array_merge($user, $entity->toArray());
            $Controller->Auth->setUser($user);
        }
    }

    protected function _getUserProfile($userId)
    {
        $profilesTb = TableRegistry::get('Profiles');
        $entity = $profilesTb->findByUserId($userId)
            ->contain([])
            ->first();
        
        return [
            'avatar_url' => $entity->avatar_url,
            'nickname' => $entity->nickname,
            'birthday' => $entity->birthday,
            'location' => $entity->location,
        ];
    }
}