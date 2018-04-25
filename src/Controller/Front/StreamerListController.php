<?php
namespace App\Controller\Front;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\AppController;
use App\Model\Logic\User\Tag;

class StreamerListController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // $this->ContentHeader->title(__('Danh sách Streamer'));
        $this->Auth->allow();
        $this->TagLg = new Tag();
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

    public function index() {
        $tag_name = $this->request->getQuery('tag');

        $this->paginate['contain'] = ['SocialProviders', 'CasterTags'];
        // if ($tag_name != null) $this->paginate['conditions'] = ['CasterTags.tag_id' => $tag_name];
        $profiles = $this->paginate('Profiles');
        $allTags = $this->TagLg->getAll();

        $this->set(compact('profiles','allTags'));
    }
}
