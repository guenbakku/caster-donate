<?php
/**
 * NOTE: hiện tại chưa có chỗ nào dùng helper này
 * Nhưng có thể code sẽ dùng được ở đâu đó sau này, nên để lại.
 */
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;
use Cake\Utility\Hash;

class JQueryInputMaskHelper extends Helper
{
    protected static $formats = [
        'vi_VN' => [
            'date' => 'dd/mm/yyyy',
        ],
        'ja_JP' => [
            'date' => 'yyyy/mm/dd',
        ],
        'en_US' => [
            'date' => 'mm/dd/yyyy',
        ]
    ];

    public function initialize(array $config)
    {
        $this->defaultLocale = Configure::read('App.defaultLocale');
    }

    public function __call($name, $args)
    {
        $locale = Hash::get($args, 0);
        if (empty($locale)) {
            $locale = $this->defaultLocale;
        }
    
        return Hash::get(static::$formats, $locale.'.'.$name);
    }
}