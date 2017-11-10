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
        $this->schedule_event_labelsTb = TableRegistry::get('ScheduleEventLabels');
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

        $scheduleEventLabels = $this->schedule_event_labelsTb
            ->findByUserId($this->Auth->user('id'))
            ->all()
            ->toArray();
        $labelDatas = [];
        foreach($scheduleEventLabels as $key => $label){
            $labelDatas[$key] = [
                'id' => $label->id,
                'title' => $label->title,
                'color' => $label->color,
                'className' => $label->className,
            ];
        }
        $this->set(compact(['eventDatas','labelDatas']));
    }
    
    public function edit() 
    {
        $this->autoRender = false;
        if ($this->request->is('put')) {
            $post_data = $this->request->getData();                
            
            //event
            $event_datas = json_decode ($post_data['event-datas']);
            foreach($event_datas as $key => $value)
            {
                //convert thành array để tích hợp với ORM Table
                $event_datas[$key] = (array)$value;                
            }            
            foreach($event_datas as $key => $value)
            {
                //xóa id của những event mới do client tạo ra
                if($value['isNew'] == true)
                {
                    $event_datas[$key]['id'] = '';
                }

                $event_datas[$key]['start'] = Time::parse($value['start']);
                $event_datas[$key]['end'] = Time::parse($value['end']);                
                //nếu khoảng cách giữa start và end là 1(ngày) => cả ngày
                if (    (   $event_datas[$key]['start']->diffInDays($event_datas[$key]['end'])  )     == 1    )
                {
                    $event_datas[$key]['allDay'] = true;
                }
            }
            //xóa events cũ
            $this->schedulesTb->query()->delete()->where(['user_id' => $this->Auth->user('id')])->execute();   
            $calendar['schedules'] = $event_datas;        

            //label
            $event_labels = json_decode ($post_data['event-labels']);
            foreach($event_labels as $key => $value)
            {
                //convert thành array để tích hợp với ORM Table
                $event_labels[$key] = (array)$value;                
            }
            //xóa labels cũ
            $this->schedule_event_labelsTb->query()->delete()->where(['user_id' => $this->Auth->user('id')])->execute();
            $calendar['schedule_event_labels'] = $event_labels;

            //cập nhật thông tin mới
            $Profile = $this->profilesTb
                ->findByUserId($this->Auth->user('id'))
                ->contain(['Schedules','ScheduleEventLabels'])
                ->first();
            $this->profilesTb->patchEntity($Profile, $calendar);
            $this->profilesTb->save($Profile);
        }
        // debug($Profile);
        return $this->redirect([
            'action' => 'index'
        ]);
    }
}
