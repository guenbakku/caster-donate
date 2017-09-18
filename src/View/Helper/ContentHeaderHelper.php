<?php

namespace App\View\Helper;

use Cake\View\Helper;
use App\Controller\Component\ContentHeaderComponent;

/**
 * Manage content's title helper.
 * Use for accessing title value set by ContentTitleComponent.
 */
class ContentHeaderHelper extends Helper
{
    public $helpers = ['Html'];

    /**
     * Get content's title set by ContentTitleComponent
     */
    public function title(string $tag = null, array $options = [])
    {
        $key['title'] = ContentHeaderComponent::$key['title'];
        $title = $this->_View->get($key['title']);
        if ($title === null) {
            return null;
        }
        $wrapped = $this->Html->tag($tag, __($title), $options);
        return $wrapped;
    }

}