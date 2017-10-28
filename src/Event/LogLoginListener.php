<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class LogLoginListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'logLogin',
            UsersAuthComponent::EVENT_AFTER_COOKIE_LOGIN => 'logLogin',
        ];
    }

    public function logLogin($event)
    {
        $Controller = $event->getSubject();
        $loginLogsTb = TableRegistry::get('LoginLogs');

        // Trust HTTP_X headers set by most load balancers.
        // This must be enabled to get true ip of client.
        $Controller->request->trustProxy = true;
        
        $log = $loginLogsTb->newEntity();
        $log->user_id = $Controller->Auth->user('id');
        $log->client_ip = $Controller->request->clientIp();
        $log->user_agent = env('HTTP_USER_AGENT');

        $loginLogsTb->save($log);
    }
}