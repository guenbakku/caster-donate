<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use App\Controller\AppController;
use App\Exception\ValidateErrorException;

class EmailController extends AppController
{
    use CustomUsersTableTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('ReAuthenticate', [
            'bindActions' => ['edit'],
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Địa chỉ email'));
    }

    public function index()
    {
        $Table = TableRegistry::get('users');
        $user_id = $this->Auth->user('id');
        $user = $Table->findById($user_id)->first();
        $this->set(compact('user'));
    }

    public function edit()
    {   
        $Table = TableRegistry::get('users');
        $user_id = $this->Auth->user('id');
        $user = $Table->findById($user_id)->first();

        if ($this->request->is('put')) {
            try {
                $user = $Table->patchEntity(
                    $user,
                    $this->request->getData(),
                    ['validate' => 'email']
                );
    
                if ($user->errors()) {
                    throw new ValidateErrorException();
                } else {
                    // This is needed for enable buidRule for email 
                    // in table Users of plugin CakeDC/User
                    $Table->isValidateEmail = true;

                    $result = $Table->save($user);
                    if ($result === false) {
                        throw new ValidateErrorException();
                    }
                    // Trigger event after edited profile
                    $this->dispatchEvent(
                        Configure::read('Events.App_AfterEditEmail'), 
                        ['user' => $user]
                    );
                    $this->Flash->success(__('Thay đổi địa chỉ email thành công'));
                    $this->redirect(['action' => 'index']);
                }
            } catch (ValidateErrorException $e) {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
            }
        }

        $this->set(compact('user'));
    }
}
