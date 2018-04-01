<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;

/**
 * Provide method to patch array to \Cake\Http\ServerRequest::data
 */
class RequestDataPatcherComponent extends Component
{
    /**
     * Patch array to \Cake\Http\ServerRequest::data of Controller
     *
     * @param   array
     * @return  void
     */
    public function patch(array $data) {
        $Controller = $this->getController();
        foreach ($data as $path => $value) {
            $Controller->request->data($path, $value);
        }
    }
}