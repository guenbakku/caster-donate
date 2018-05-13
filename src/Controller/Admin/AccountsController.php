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
        $accounts = $this->paginate($accountsLg->search($conditions));

        $this->set(compact('accounts'));
    }
}
