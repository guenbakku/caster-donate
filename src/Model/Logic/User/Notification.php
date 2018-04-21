<?php
namespace App\Model\Logic\User;

use Cake\Datasource\Paginator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Validation\Validation;
use Cake\I18n\Time;

class Notification
{
    public $pageParams = []; 

    public function __construct ()
    {
        $this->NotificationTb = TableRegistry::get('Notifications');
        $this->paginator = new Paginator();
    }

    /**
     * Gửi thông báo đến User
     *
     * @param array $notification
     * @return  Entity|null
     */
    public function notify($new_notification)
    {
        $notification = $this->NotificationTb->newEntity();
        $this->NotificationTb->patchEntity($notification, $new_notification);

        if (!$notification->errors()) {
            $this->NotificationTb->save($notification);
        }
        return $notification;
    }

    public function notifyAll($new_notification)
    {
    }
    
    /*
    *   Gửi trả các thông báo theo mối liên kết notifications -> notification_templates -> notification_types
    *   Tạo field notifications.content từ biến và mẫu của thông báo
    *
    *   @param uuid $user_id
    *   @param array $paginator_config : 
    */
    public function getNewNotify($user_id, $paginator_config = [])
    {
        $paginator_config = array_merge($paginator_config,[
            'limit' => 10,
            'order' => [
                'Notifications.created' => 'desc'
            ]
        ]);
        $notifications = $this->paginator->paginate(
            $this->NotificationTb->findByUserId($user_id)->contain(['NotificationTemplates.NotificationTypes']),
            $paginator_config
        );

        if (empty($notifications)) 
        {
            $notifications = $this->NotificationTb->newEntity();
        }else{
            foreach ($notifications as $notification)
            {
                $notification['content'] = $this->replateVar($notification->notification_template->template, $notification->vars);
            }
        }        
        $this->pageParams = $this->paginator->getPagingParams() ;
        return $notifications;
    }

    /*
     *  @param string $template
     *  @param array $jsonVars
     *  return string
     */
    public function replateVar($template, $jsonVars)
    {
        $obj = json_decode($jsonVars);
        $content = $template;
        foreach ($obj as $key => $value) {
            $content = str_replace('{'.$key.'}', $value, $content);
        }
        return $content;
    }
    
    public function seenAll($user_id)
    {
        if ($this->NotificationTb->updateAll(
            ['seen' => Time::now()],//set
            [
                'user_id' => $user_id,
                'seen is' => null
            ] //where
        )){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function seen($notif_id)
    {
        $notification = $this->NotificationTb->findById($notif_id)
            ->contain(['NotificationTemplates'])
            ->first();
        
        if (!empty($notification))
        {
            $notification->seen = Time::now();
            $this->NotificationTb->save($notification);
        }
        return $notification;

    }
}
?>