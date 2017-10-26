<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Money;

class DonateController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Trang Donate của Caster'));
        $this->Auth->allow();
    }

    public function index($user_id = null) 
    {
        $Profile = new Profile();

        $Donates = TableRegistry::get('Donates');
        $donate =  $Donates->newEntity();

        $TransferMethods = TableRegistry::get('TransferMethods');
        $transferMethods = $TransferMethods->find();
        
        $caster_profile = $Profile->get($user_id);        
        if ($caster_profile->isNew())
        {
            throw new NotFoundException();
        }
        // debug($this->Auth->user());
        $this->set(compact('caster_profile'));
    }

    public function perform($user_id = null)
    {
        if ($this->request->is('put')) 
        {
            $Money = new Money();
            $donateDatas = $this->request->getData();
            /*1')   - Xác nhận kết quả chuyển tiền từ bên 3 nếu không phải là Donate bằng Coin
                    - Quy đổi số tiền thành Coin
            */
            //1'')Xác nhận số dư Coin của người Donate nếu Donate bằng Coin
            if($donateDatas['donate_method_selector'] == 'coin')
            {
                if($Money->getCurrentBalance($donateDatas['sender_id']) < $donateDatas['amount'])
                {
                    $this->Flash->error(__('Số dư trong tài khoản không đủ'));
                    return $this->redirect('/donate/'.$user_id);
                }
            }
            //2)Thực hiện Donate
            $result = $Money->donate($donateDatas);
            if($result)
            {
                $this->Flash->success("Donate thành công");
            }
            else
            {
                $this->Flash->error("Donate thất bại");
            }
        }
        else
        {
            $this->Flash->error("Có lỗi xảy ra trong quá trình donate");
        }
        return $this->redirect('/donate/'.$user_id);
    }
}
