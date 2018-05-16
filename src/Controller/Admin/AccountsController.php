<?php
namespace App\Controller\Admin;

use Cake\Event\Event;
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
}
