<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class ArticleController extends AppController
{
    public $paginate = [
        'limit' => 1,
        'order' => [
            'Articles.created' => 'desc'
        ],
        'page'=> 1
    ];
    public $helpers = [
        'Paginator' => [
            'templates' => 'paginator_template',
        ]
    ];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Blog cá nhân'));
        $this->articlesTb = TableRegistry::get('Articles');
    }

    public function index()
    {
        $query = $this->articlesTb->find()
                    ->where(['user_id' => $this->Auth->user('id')])
                    ->order(['Articles.created' => 'desc']);
        $Articles = $this->paginate($query);

        if ($this->request->is('put')) {// Đăng bài mới
            $ArticleDatas = $this->request->getData();
            $ArticleDatas['user_id'] = $this->Auth->user('id');
            $article = $this->articlesTb->newEntity($ArticleDatas);
            
            if (!$article->errors()) {   
                $this->articlesTb->save($article);
                $this->Flash->success(__('Đăng bài thành công.'));
                $this->redirect($this->request->referer());
            }else{
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập.'));
            }
        }else{
            $article = $this->articlesTb->newEntity();
        }
        $this->set(compact('article','Articles'));
    }

    public function edit($articleId)
    {
        $article =$this->checkArticleAuthor($articleId);

        if ($this->request->is('put')) {
            $article = $this->articlesTb->patchEntity($article,$this->request->getData());
            if (!$article->errors()) {   
                $this->articlesTb->save($article);
                $this->Flash->success(__('Chỉnh sửa thành công.'));
                $this->redirect(['action' => 'index']);
            }else {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập.'));
            }
        }
        $this->set(compact('article'));
    }

    public function delete($articleId)
    {
        $article = $this->checkArticleAuthor($articleId);
        
        $result = $this->articlesTb->delete($article);
        $this->Flash->success(__('Đã xóa bài viết.'));
        $this->redirect(['action' => 'index']);
    }

    private function checkArticleAuthor($articleId)
    {
        $article = $this->articlesTb->find()
        ->where(['id' => $articleId, 'user_id' => $this->Auth->user('id')])
        ->first();
        if($article == null)
        {
            $this->Flash->error(__('Không tìm thấy bài viết.'));
            $this->redirect(['action' => 'index']);
        }else{
            return $article;
        }
    }
}
