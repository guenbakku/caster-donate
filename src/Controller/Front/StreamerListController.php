<?php
namespace App\Controller\Front;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\AppController;

class StreamerListController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // $this->ContentHeader->title(__('Danh sách Streamer'));
        $this->Auth->allow();
        $this->profilesTb = TableRegistry::get('Profiles');
    }

    public $paginate = [
        'limit' => 15,
        'order' => [
            'Profiles.created' => 'desc'
        ],
        'page'=> 1
    ];
    public $helpers = [
        'Paginator' => ['templates' => 'paginator_template']
    ];

    /**
     * Hiển thị danh sách Streamer theo trang,
     *      - kết quả sẽ được lọc theo biến GET có tên 'tag' và 'nickname' với phương thức AND
     */
    public function index() {
        $tagName = $this->request->getQuery('tag');
        $nickName = $this->request->getQuery('nickname');

        $this->paginate['contain'] = ['SocialProviders', 'CasterTags'];
        $query = $this->profilesTb->find()->order(['Profiles.created' => 'desc']);

        //Tìm theo tag
        if ($tagName != null) 
        {
            $query->matching('CasterTags', function($q) use ($tagName) {
                return $q->where([
                    'CasterTags.name' => $tagName
                ]);
            });
        }

        //Tìm theo tên
        if ($nickName != null) 
        {
            $query->where(['Profiles.nickname LIKE' => '%'.$nickName.'%']);
        }
        
        //phân trang
        $profiles = $this->paginate($query);
        $allTags = $this->profilesTb->CasterTags->find('all');

        $this->set(compact('profiles','allTags'));
    }
}
