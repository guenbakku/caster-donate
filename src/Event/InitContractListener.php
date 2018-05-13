<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use App\Utility\Flysystem;
use App\Utility\File;

class InitContractListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'createContractAfterUserRegister',
        ];
    }

    public function createContractAfterUserRegister($event)
    {
        $user_id = $event->getData('user')->id;
        $contractsTb = TableRegistry::get('Contracts');

        // Insert one record to `contracts` table
        $exists = $contractsTb->exists(['user_id' => $user_id]);
        if (!$exists) {
            $contract = $contractsTb->newEntity(
                ['user_id' => $user_id, 'status_id' => 1], 
                ['validate' => false]
            );
            $contractsTb->save($contract);
        }
    }
}