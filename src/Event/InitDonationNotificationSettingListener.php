<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;

class InitDonationNotificationSettingListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            Configure::read('Events.App_AfterCreateContract') => 'createDonationNotificationSettingAfterCreateContract',
        ];
    }

    public function createDonationNotificationSettingAfterCreateContract($event)
    {
        $user_id = $event->getData('contract')->user_id;
        $DNSettingsTb = TableRegistry::get('DonationNotificationSettings');

        $exists = $DNSettingsTb->exists(['user_id' => $user_id]);

        if (!$exists) {
            $entity = $DNSettingsTb->newEntity();
            $entity->setDefaultValue();
            $entity->user_id = $user_id;
            $DNSettingsTb->save($entity);
        }
    }
}