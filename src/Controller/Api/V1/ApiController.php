<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\Network\Exception\BadRequestException;
use App\Controller\AppController;

class ApiController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if (!Configure::read('debug')) {
            if (!$this->request->is('ajax')) {
                throw new BadRequestException('Need ajax request');
            }
        }

        // $this->eventManager()->off($this->Csrf);
        $this->viewBuilder()->layout('ajax');
        $this->response = $this->response
            ->withCharset('UTF-8')
            ->withType('json');
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->set('_serialize', false);
    }
}
