<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Pass content header to view
 */
class ContentHeaderComponent extends Component
{
    public static $key = [
        'title' => '_content_title',
    ];

    /**
     * Set title value to view's variable
     *
     * @param   string: title
     * @return  void
     */
    public function title(string $title) {
        $controller = $this->_registry->getController();
        $controller->set(static::$key['title'], $title);
    }
}