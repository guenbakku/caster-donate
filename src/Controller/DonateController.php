<?php

namespace App\Controller;

use Cake\Core\Configure;
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

        $caster_profile = $Profile->get($user_id);        
        if($caster_profile->isNew())
        {
            $this->render('usernotfound');
            return;
        }
        // debug($this->Auth->user());
        $this->set(compact('caster_profile'));
    }

    public function do($user_id = null)
    {
        if ($this->request->is('put')) 
        {
            /*1')   - Xác nhận kết quả chuyển tiền từ bên 3 nếu không phải là Donate bằng Coin
                    - Quy đổi số tiền thành Coin
            */
            //1'')Xác nhận số dư Coin của người Donate nếu Donate bằng Coin
            //2)Thực hiện Donate
            $Money = new Money();
            $donateDatas = $this->request->getData();
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
