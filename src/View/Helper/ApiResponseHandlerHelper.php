<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Handle setting response for api
 */
class ApiResponseHandlerHelper extends Helper
{
    protected $defaultResult = [
        'title' => null,
        'message' => null,
        'data' => null,
        'errors' => [],
    ];

    /**
     * Set result for Api
     *
     * @param   array
     * @param   bool: convert to json or not
     * @return  array 
     */
    public function setResult(array $result, bool $toJson = true)
    {
        $result = array_merge($this->defaultResult, $result);
        return $toJson? json_encode($result) : $result;
    }
}
