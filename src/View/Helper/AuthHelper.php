<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;

/**
 * Access data of Auth in session.
 */
class AuthHelper extends Helper
{
    /**
     * @param   string: method (must in camelCase)
     * @param   array: first item contain path to value in session
     */
    public function user(string $path = null)
    {
        $storageKey = Configure::read('Auth.storage.key', 'Auth.User');
        $fullpath = implode('.', array_filter(
            [$storageKey, $path], 
            function ($item) {
                return $item != '' || (string)$item === '0';
            }
        ));

        return $this->request->session()->read($fullpath);
    }
}
