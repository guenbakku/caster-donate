<?php
namespace App\Controller\Admin;

use Cake\Event\Event;
use Cake\Utility\Inflector;
use App\Controller\Admin\BaseController;

/**
 * Accounts Controller
 *
 */
class AccountsController extends BaseController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Quản lý tài khoản'));
    }

    public function index()
    {
        $conditions = $this->request->getQuery();
        $accountsLg = new \App\Model\Logic\Admin\Accounts;
        $query = $accountsLg->search($conditions);
        $accounts = $this->paginate($query, [
            'limit' => 20,
            'sortWhitelist' => [
                'Users.username', 'Users.email', 'ContractStatuses.name',
                'Users.is_superuser', 'Users.activation_date'
            ],
            'order' => ['Users.activation_date' => 'desc'],
        ]);

        $this->set(compact('accounts'));
    }

    /**
     * Đóng vai trò proxy cho các method xem thông tin bên dưới
     */
    public function view($method, $userId)
    {
        $call = Inflector::variable('view-'.$method);
        $template = Inflector::underscore($method);
        call_user_func([$this, $call], $userId);
        $this->render($template);
    }

    protected function viewProfile($userId)
    {
        $profileLg = new \App\Model\Logic\User\Profile;
        $profile = $profileLg->get($userId);
        $this->set(compact('userId', 'profile'));
    }

    protected function viewContract($userId)
    {
        $contractLg = new \App\Model\Logic\User\Contract;
        $contract = $contractLg->getByUserId($userId);
        $this->set(compact('userId', 'contract'));
        debug($contract);
    }
}
