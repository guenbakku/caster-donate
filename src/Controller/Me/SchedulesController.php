<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class SchedulesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->ContentHeader->title(__('Lịch lên sóng'));
        $this->profilesTb = TableRegistry::get('Profiles');
        $this->schedulesTb = TableRegistry::get('Schedules');
    }

    public function index()
    {
        $schedules = $this->schedulesTb
            ->findByUserId($this->Auth->user('id'))
            ->all()
            ->toArray();
        $eventDatas = [];
        foreach($schedules as $key => $value){
            $eventDatas[$key] = [
                '_id' => $value->id,
                'title' => $value->title,
                'isNew' => false,
                'start' => $value->start,
                'end' => $value->end,
                'allDay' => $value->allDay,
                'className' => json_decode($value->className),
            ];
        }
        $eventDatas = json_encode($eventDatas);
        $this->set(compact('eventDatas'));
    }
    
    public function edit() 
    {
        $this->autoRender = false;
        if ($this->request->is('put')) {
            $post_data = $this->request->getData();
            $schedules = json_decode ($post_data['event-datas']);
            
            foreach($schedules as $key => $value)
            {
                //convert thành array để tích hợp với ORM Table
                $schedules[$key] = (array)$value;                
            }
            
            foreach($schedules as $key => $value)
            {
                //xóa id của những event mới do client tạo ra
                if($value['isNew'] == true)
                {
                    $schedules[$key]['id'] = '';
                }

                $schedules[$key]['start'] = Time::parse($value['start']);
                $schedules[$key]['end'] = Time::parse($value['end']);                
                //nếu khoảng cách giữa start và end là 1(ngày) => cả ngày
                if (    (   $schedules[$key]['start']->diffInDays($schedules[$key]['end'])  )     == 1    )
                {
                    $schedules[$key]['allDay'] = true;
                }
            }

            //xóa events cũ
            $this->schedulesTb->query()->delete()->where(['user_id' => $this->Auth->user('id')])->execute();
           
            //cập nhật thông tin event mới
            $event_datas['schedules'] = $schedules;
            $Profile = $this->profilesTb
                ->findByUserId($this->Auth->user('id'))
                ->contain(['Schedules'])
                ->first();            
            $this->profilesTb->patchEntity($Profile, $event_datas);
            $this->profilesTb->save($Profile);

        }

        return $this->redirect([
            'action' => 'index'
        ]);
    }
}
