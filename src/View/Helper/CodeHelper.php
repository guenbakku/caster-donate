<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use App\Utility\Code;

/**
 * Wrapper of \App\Utility\Code
 */
class CodeHelper extends Helper
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->Code = new Code($config);
    }
    
    /**
     * Wrapper of Code::getList()
     */
    public function getList(string $table, array $options = [])
    {
        return $this->Code->getList($table, $options);
    }

    /**
     * Wrapper of Code::getKey()
     */
    public function getKey(string $table, string $selector, array $options = [])
    {
        return $this->Code->getKey($table, $selector, $options);
    }

    /**
     * Wrapper of Code::setTable()
     */
    public function setTable(string $table)
    {
        return $this->Code->setTable($table);
    }

    /**
     * Wrapper of Code::getTable()
     */
    public function getTable()
    {
        return $this->Code->getTable();
    }

    /**
     * Wrapper of Code::clearCache()
     */
    public function clearCache()
    {
        return $this->Code->clearCache();
    }
}
