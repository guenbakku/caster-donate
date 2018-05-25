<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class ArticleController extends AppController
{
    public $paginate = [
        'limit' => 15,
        'order' => [
            'Articles.created' => 'desc'
        ],
        'page'=> 1
    ];
    public $helpers = [
        'Paginator' => ['templates' => 'paginator_template']
    ];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Biên tập bài viết'));
        $this->articlesTb = TableRegistry::get('Articles');
        $query = $this->articlesTb->find()->order(['Articles.created' => 'desc']);
        $articles = $this->paginate($query);
        $this->set(compact('articles'));
    }

    public function index()
    {
        $user_id = $this->Auth->user('id');

        if ($this->request->is('put')) {
            $ArticleDatas = $this->request->getData();
            $ArticleDatas['user_id'] = $user_id;
            $article = $this->articlesTb->newEntity($ArticleDatas);
            
            if (!$article->errors()) {   
                $this->articlesTb->save($article);
                $this->Flash->success(__('Đăng bài thành công.'));
                $this->redirect($this->request->referer());
            } else {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập.'));
            }
        } else {
            $article = $this->articlesTb->newEntity();
        }
        $this->set(compact('article'));
    }

    public function edit()
    {

    }

    public function delete()
    {
       
    }
}
