<?php
namespace App\Model\Validation;

use Cake\Validation\Validation;

class ContactValidation extends Validation {
    /**
     * Validate phone number
     *
     * @param string $value
     * @return bool
     */
    public static function phone($value) {
        return (bool) preg_match('/^[0-9\-\s]+$/', $value);
    }

}