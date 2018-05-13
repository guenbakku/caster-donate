<?php
namespace App\Model\Validation;

use Cake\Validation\Validation;

class ContactValidation extends Validation {

    /**
     * Validate phone number
     *
     * @param   string $value
     * @return  bool
     */
    public static function phone($value)
    {
        if ((bool) preg_match('/^[0-9\-\s]+$/', $value) === false) {
            return __('Chỉ được nhập số, khoảng trắng và dấu -');
        }
        return true;
    }

    /**
     * Validate username format
     *
     * @param   string: $value
     * @return  bool
     */
    public static function username($value)
    {
        if ((bool) preg_match('/^[0-9a-zA-Z\-\_\.]+$/', $value) === false) {
            return __('Chỉ được nhập chữ không dấu, số, và các ký tự: ., -, _');
        }
        return true;
    }
}