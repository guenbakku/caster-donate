<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Logic\Profile\Profile;
use App\Controller\Component\UploadFileComponentComponent;

class MeController extends AppController
{
    public function index() 
    {
        return $this->redirect(['action' => 'statistics']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title('Trang cá nhân');

        // Set default render setting
        $user_id = $this->Auth->user('id');
        if ($this->request->is('get'))
        {
            $this->Profile = new Profile();
            $profile = $this->Profile->get($user_id);
        }
        $this->set(compact('profile'));
    }

    public function statistics()
    {
        $this->render('/Me/index');
    }

    public function schedule() 
    {
        $this->render('/Me/index');
    }

    public function profile()
    {
        $user_id = $this->Auth->user('id');
        
        if($this->request->is(['patch','post','put']))
        {
            //Nếu có file upload
            if($this->request->data['avatar']['error'] == false)
            {
                //lưu file
                $this->UploadFile = $this->loadComponent('UploadFileComponent');

                $allowed_file_type = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif',];
                $dir = '/img/avatars';
                $limitFileSize = 1024 * 1024;
                $upload_result = $this->UploadFile->uploadFile($this->request->data['avatar'], $dir, $limitFileSize, $allowed_file_type);
                if(!$upload_result['error']) 
                {
                    $this->request->data['avatar'] =  'avatars/'.$upload_result['file_name'];
                }else 
                {
                    $this->Flash->error(!$upload_result['error_message']);
                }
            }

            $this->Profile = new Profile();
            $new_user_info = $this->request->getData();
            //
            $profile = $this->Profile->edit($user_id, $new_user_info);
            if(!$profile->errors())
            {
                $this->Flash->success(__('Thay đổi thông tin cá nhân thành công.'));
            }
            else
            {
                if ($profile->errors()){
                    $this->Flash->error(__('Vui lòng kiểm tra thông tin đã điền.'));                    
                }else
                {
                    $this->Flash->error(__('Không thể cập nhật thông tin.'));                    
                }
            }
        }

        $this->render('/Me/index');
    }

}
