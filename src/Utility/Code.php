<?php

namespace App\Utility;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Core\InstanceConfigTrait;
use InvalidArgumentException;
use App\Utility\CentralCacheTrait;

/**
 * Manage code table.
 * Use for accessing code in code table to display in <select> tag.
 */
class Code
{
    use InstanceConfigTrait;
    use CentralCacheTrait;

    protected $_defaultConfig = [
        'keyField' => 'id',
        'valueField' => 'name',
        'selectorField' => 'selector',
        'orderField' => 'order',
    ];

    // Callback for adding custom conditions to query
    // before retrieving data from database
    protected $_filter = null;

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
     * @param   array: contains custom keyField and valueField
     * @return  array
     */
    public function getList(array $options = [])
    {
        $options = array_merge($this->getConfig(), $options);
        $table = $this->getTable();
        $results = [];

        // We only cache results if filter was not provided
        if (is_callable($this->_filter)) {
            $results = $this->readDBForList($table, $options);
            $this->clearFilter();
        } else {
            $prefix = 'list';
            $hash = $this->hash($table, $options);
            $key = $this->cacheKey($hash, $prefix);
            $results = $this->rememberCache($key, function () use ($table, $options) {
                return $this->readDBForList($table, $options);
            });
        }

        return $results;
    }

    /**
     * Return key (id) of specific selector in specific code table
     *
     * @param   string: selector
     * @param   string|null: field want to get, if null is provided entity class will be returned
     * @return  mixed
     */
    public function getKey(string $selector, string $field = null)
    {
        $table = $this->getTable();
        $results = null;

        // We only cache results if filter was not provided
        if (is_callable($this->_filter)) {
            $results = $this->readDBForKey($table, $selector);
            $this->clearFilter();
        } else {
            $prefix = 'key';
            $hash = $this->hash($table, [$selector]);
            $key = $this->cacheKey($hash, $prefix);
            $results = $this->rememberCache($key, function () use ($table, $selector) {
                return $this->readDBForKey($table, $selector);
            });
        }

        return $field === null? $results : $results->$field;
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
     * Set filter callback
     *
     * @param   Callable: function that accepts query object as input and return query object as output
     * @return  object: this
     *
     * @throws \InvalidArgumentException if the $filter is not callable
     */
    public function filter(Callable $filter) {
        $this->_filter = $filter;
        return $this;
    }

    /**
     * Clear filter (useful when write unit test case)
     *
     * @param   void
     * @return  null
     */
    public function clearFilter() {
        return $this->_filter = null;
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

        if (is_callable($this->_filter)) {
            $query = ($this->_filter)($query);
        }

        return $query->toArray();
    }

    /**
     * Return key of indentify get from database
     *
     * @param   string: table name
     * @return  object: entity
     */
    protected function readDBForKey(string $table, string $selector)
    {
        $table = TableRegistry::get($table);
        $query = $table->find()->where([
            $this->getConfig('selectorField') => $selector,
        ]);

        if (is_callable($this->_filter)) {
            $query = ($this->_filter)($query);
        }

        return $query->first();
    }

    /**
    * Convert input to hash by using MD5
    *
    * @param   string: table name
    * @param   array: options
    * @return  string
    */
    protected function hash(string $table, array $options = [])
    {
        return md5($table.' '.json_encode($options));
    }
}