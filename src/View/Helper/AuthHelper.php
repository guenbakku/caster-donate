<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Access data of Auth in session.
 */
class AuthHelper extends Helper
{
    public static $prefix = 'Auth';

    /**
     * @param   string: method (must in camelCase)
     * @param   array: first item contain path to value in session
     */
    public function __call($name, $args)
    {
        $group = ucfirst($name);
        $prefix = static::$prefix.'.'.$group;
        $path = implode('.', $args);
        $fullpath = implode('.', array_filter(
            [$prefix, $path], 
            function ($item) {
                return $item != '' || (string)$item === '0';
            }
        ));

        return $this->request->session()->read($fullpath);
    }
}
