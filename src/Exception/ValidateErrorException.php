<?php
namespace App\Exception;

use Cake\Core\Exception\Exception;

class ValidateErrorException extends Exception
{
    /**
     * ValidateErrorException constructor.
     * @param array|string $message message
     * @param int $code code
     * @param null $previous previous
     */
    public function __construct($message = null, $code = 500, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
