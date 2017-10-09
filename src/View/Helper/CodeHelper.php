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
     * @param   array: options
     * @return  array
     */
    public function get(string $table, array $options = [])
    {
        $key = $this->hash($table, $options);
        $result = $this->getCache($key);
        if (!$result) {
            $result = $this->getDb($table, $options);
            $this->writeCache($key, $result);
        }

        return $result;
    }

    /**
     * Return data get from database
     *
     * @param   string: table name
     * @param   array: options
     * @return  array
     */
    public function getDb(string $table, array $options = [])
    {
        $table = TableRegistry::get($table);
        $query = $table->find('list', [
            'keyField' => Hash::get($options, 'keyField', 'id'),
            'valueField' => Hash::get($options, 'valueField', 'name'),
        ]);

        $order = Hash::get($options, 'order');
        if ($order) {
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
    protected function writeCache(string $key, $result)
    {
        static::$cached[$key] = $result;
    }

    /**
     * Return cached value
     *
     * @param   string: key
     * @return  mixed
     */
    protected function getCache(string $key)
    {
        return Hash::get(static::$cached, $key);
    }
}
