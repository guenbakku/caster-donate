<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

/**
 * Manage code table.
 * Use for accessing code in code table to display in <select> tag.
 */
class CodeHelper extends Helper
{
    protected static $cached = [];
    
    /**
     * Return all records in provided table and return in list format
     * More about list format:
     * https://book.cakephp.org/3.0/ja/orm/retrieving-data-and-resultsets.html#table-find-list
     *
     * @param   string: table name
     * @param   array: contains custom keyField and valueField
     * @return  array
     */
    public function getList(string $table, array $options = [])
    {
        $group = 'list';
        $hash = $this->hash($table, $options);
        $result = $this->readCache($group, $hash);
        if (!$result) {
            $result = $this->readDBForList($table, $options);
            $this->writeCache($group, $hash, $result);
        }

        return $result;
    }

    /**
     * Return key (id) of specific identify in specific code table
     *
     * @param   string: table name
     * @param   string: identify
     * @param   mixed: key of identify
     */
    public function getKey(string $table, string $identify, array $options = [])
    {
        $group = 'key';
        $hash = $this->hash($table, $options);
        $result = $this->readCache($group, $hash);
        if (!$result) {
            $result = $this->readDBForKey($table, $options);
            $this->writeCache($group, $hash, $result);
        }

        return Hash::get($result, $identify);
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
     * @param   array: contains custom keyField and identifyField
     * @return  array
     */
    protected function readDBForKey(string $table, array $options = [])
    {
        $table = TableRegistry::get($table);
        $query = $table->find('list', [
            'keyField' => Hash::get($options, 'keyField', 'id'),
            'valueField' => Hash::get($options, 'identifyField', 'identify'),
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
            'keyField' => Hash::get($options, 'keyField', 'id'),
            'valueField' => Hash::get($options, 'valueField', 'name'),
        ]);

        $order = Hash::get($options, 'order', 'order_no');
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
    protected function hash(string $table, array $options = [])
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
    protected function writeCache(string $group, string $key, $result)
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
    protected function readCache(string $group, string $key)
    {
        $path = $group.'.'.$key;
        return Hash::get(static::$cached, $path);
    }
}
