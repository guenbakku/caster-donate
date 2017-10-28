<?php

namespace App\Utility;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Core\InstanceConfigTrait;

/**
 * Manage code table.
 * Use for accessing code in code table to display in <select> tag.
 */
class Code
{
    use InstanceConfigTrait;

    protected static $cached = [];
    protected $_defaultConfig = [
        'keyField' => 'id',
        'valueField' => 'name',
        'selectorField' => 'selector',
        'orderField' => 'order',
    ];

    protected $_table = null;

    /**
     * Default Constructor
     *
     * @param   array: Configuration settings for the helper.
     */
    public function __construct(array $config = [])
    {
        $this->setConfig($config);
    }
    
    /**
    * Return all records in provided table and return in list format
    * More about list format:
    * https://book.cakephp.org/3.0/ja/orm/retrieving-data-and-resultsets.html#table-find-list
    *
    * @param   string: table name
    * @param   array: contains custom keyField and valueField
    * @return  array
    */
    public function getList(array $options = [])
    {
        $group = 'list';
        $table = $this->getTable();
        $hash = static::hash($table, $options);
        $result = static::readCache($group, $hash);
        if (!$result) {
            $result = $this->readDBForList($table, $options);
            static::writeCache($group, $hash, $result);
        }

        return $result;
    }

    /**
    * Return key (id) of specific selector in specific code table
    *
    * @param   string: table name
    * @param   string: selector
    * @param   mixed: key of selector
    */
    public function getKey(string $selector, array $options = [])
    {
        $group = 'key';
        $table = $this->getTable();
        $hash = static::hash($table, $options);
        $result = static::readCache($group, $hash);
        if (!$result) {
            $result = $this->readDBForKey($table, $options);
            static::writeCache($group, $hash, $result);
        }

        return Hash::get($result, $selector);
    }

    /**
     * Table setter
     *
     * @param   string: table name
     * @return  object: this
     */
    public function setTable(string $table)
    {
        $this->_table = $table;
        return $this;
    }

    /**
     * Table getter
     * 
     * @param   void
     * @return  string
     */
    public function getTable()
    {
        return $this->_table;
    }

    /**
    * Clear cache (useful when write unit test case)
    *
    * @param   void
    * @return  void
    */
    public function clearCache()
    {
        return static::$cached = [];
    }

    /**
    * Return key of indentify get from database
    *
    * @param   string: table name
    * @param   array: contains custom keyField and selectorField
    * @return  array
    */
    protected function readDBForKey(string $table, array $options = [])
    {
        $table = TableRegistry::get($table);
        $query = $table->find('list', [
            'keyField' => Hash::get($options, 'keyField', $this->getConfig('keyField')),
            'valueField' => Hash::get($options, 'selectorField', $this->getConfig('selectorField')),
        ]);

        return array_flip($query->toArray());
    }

    /**
    * Return data of code group get from database
    *
    * @param   string: table name
    * @param   array: contains custom keyField and valueField
    * @return  array
    */
    protected function readDBForList(string $table, array $options = [])
    {
        $table = TableRegistry::get($table);
        $query = $table->find('list', [
            'keyField' => Hash::get($options, 'keyField', $this->getConfig('keyField')),
            'valueField' => Hash::get($options, 'valueField', $this->getConfig('valueField')),
        ]);

        $order = Hash::get($options, 'orderField', $this->getConfig('orderField'));
        if ($table->schema()->column($order)) {
            $query->order($order);
        }

        return $query->toArray();
    }

    /**
    * Convert input to hash by using MD5
    *
    * @param   string: table name
    * @param   array: options
    * @return  string
    */
    protected static function hash(string $table, array $options = [])
    {
        return md5($table.' '.json_encode($options));
    }

    /**
    * Cache result to memory to improve perfomance
    * when same result is retrieved
    *
    * @param   string: key
    * @param   mixed: result
    * @return  void
    */
    protected static function writeCache(string $group, string $key, $result)
    {
        $path = $group.'.'.$key;
        Hash::insert(static::$cached, $path, $result);
    }

    /**
    * Return cached value
    *
    * @param   string: key
    * @return  mixed
    */
    protected static function readCache(string $group, string $key)
    {
        $path = $group.'.'.$key;
        return Hash::get(static::$cached, $path);
    }
}