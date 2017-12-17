<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Validation\Validator;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use CakeDC\Users\Exception\UserNotActiveException;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use App\Controller\AppController;

class PasswordController extends AppController
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
        $this->ContentHeader->title(__('Mật khẩu'));
    }

    public function edit()
    {
        $user = $this->getUsersTable()->newEntity();
        $user->id = $this->Auth->user('id');

        if ($this->request->is('put')) {
            try {
                $validator = $this->getUsersTable()->validationPasswordConfirm(new Validator());
                $user = $this->getUsersTable()->patchEntity(
                    $user,
                    $this->request->getData(),
                    ['validate' => $validator]
                );
                if ($user->errors()) {
                    $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
                } else {
                    $user = $this->getUsersTable()->changePassword($user);
                    if ($user) {
                        $this->Flash->success(__d('CakeDC/Users', 'Password has been changed successfully'));
                    } else {
                        $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('CakeDC/Users', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error(__d('CakeDC/Users', '{0}', $wpe->getMessage()));
            } catch (Exception $exception) {
                $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
                $this->log($exception->getMessage());
            }
        }

        $this->set(compact('user'));
    }
}
