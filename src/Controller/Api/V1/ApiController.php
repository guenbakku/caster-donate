<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\Network\Exception\BadRequestException;
use App\Controller\AppController;
use App\Model\Logic\Profile\Tag;

class ApiController extends AppController
{
    public function beforeFilter(Event $event)
    {
        if (!Configure::read('debug')) {
            if (!$this->request->is('ajax')) {
                throw new BadRequestException('Need ajax request');
            }
        }

        parent::beforeFilter($event);

        $this->loadComponent('RequestHandler');
        $this->eventManager()->off($this->Csrf);
        $this->viewBuilder()->layout('ajax');
        $this->response->charset('UTF-8');
        $this->response->type('json');
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set('_serialize', false);
    }
}
