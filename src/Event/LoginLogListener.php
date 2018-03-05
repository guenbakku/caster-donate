<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class LoginLogListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            'Auth.afterIdentify' => 'log',
        ];
    }

    public function log($event)
    {
        $Controller = $event->getSubject();
        $user = $event->getData(0);
        $loginLogsTb = TableRegistry::get('LoginLogs');

        // Trust HTTP_X headers set by most load balancers.
        // This must be enabled to get true ip of client.
        $Controller->request->trustProxy = true;
        
        $log = $loginLogsTb->newEntity();
        $log->user_id = $user['id'];
        $log->client_ip = $Controller->request->clientIp();
        $log->user_agent = env('HTTP_USER_AGENT');

        $loginLogsTb->save($log);
    }
}