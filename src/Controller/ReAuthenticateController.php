<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;

class ReAuthenticateController extends AppController
{
    use CustomUsersTableTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ReAuthenticate');
    }

    public function confirm()
    {
        if ($this->request->is('post')) {
            try {
                $user = $this->getUsersTable()->newEntity();
                $user->id = $this->Auth->user('id');
                
                $validator = $this->getUsersTable()->validationCurrentPassword(new Validator());
                $user = $this->getUsersTable()->patchEntity(
                    $user,
                    $this->request->getData(),
                    ['validate' => $validator]
                );

                $current_user = $this->getUsersTable()->findById($user->id)->first();
                if (empty($current_user)) {
                    throw new UserNotFoundException('');
                }
                if (!$user->checkPassword($user->current_password, $current_user->password)) {
                    throw new WrongPasswordException('');
                }

                $this->ReAuthenticate->setSession();
                $this->redirect($this->Auth->redirectUrl());
            } catch (UserNotFoundException $e) {
                $this->Flash->error(__d('CakeDC/Users', 'User was not found'));
            } catch (WrongPasswordException $e) {
                $this->Flash->error(__d('CakeDC/Users', 'The current password does not match'));
            }
        }
    }
}
