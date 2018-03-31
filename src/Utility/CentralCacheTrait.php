<?php

namespace App\Utility;

use Cake\Utility\Hash;

/**
 * A trait provide cache method for static class.
 */
trait CentralCacheTrait
{
    protected static $cached = [];

    /**
     * Create full cache key by combining prefix and key into one and hash it by md5
     *
     * @param   string: key
     * @param   string: prefix
     * @return  string
     */
    public function cacheKey(string $key, string $prefix = null)
    {
        return $prefix.'_'.$key;
    }

    /**
     * Read a key from the cache. 
     * Return false to indicate the entry does not exist.
     *
     * @param   string: key
     * @return  mixed
     */
    public function readCache(string $key)
    {
        if (Hash::check(static::$cached, $key)) {
            return Hash::get(static::$cached, $key);
        }
        return false;
    }

    /**
     * Write value for a key into cache.
     *
     * @param   string: key
     * @param   mixed: data
     */
    public function writeCache(string $key, $value)
    {
        static::$cached = Hash::insert(static::$cached, $key, $value);
    }

    /**
     * Provides the ability to easily do read-through caching.
     *
     * When called if the $key is not set in $config, the $callable function
     * will be invoked. The results will then be stored into the cache config
     * at key.
     *
     * @param   string: key
     * @param   callable: The callable that provides data in the case when 
     *   the cache key is empty
     * @return  mixed
     */
    public function rememberCache(string $key, Callable $callable)
    {
        $results = $this->readCache($key);
        if ($results === false) {
            $results = call_user_func($callable);
            $this->writeCache($key, $results);
        }
        return $results;
    }

    /**
     * Clear all cached data
     *
     * @param   void
     * @return  void
     */
    public function clearCache()
    {
        static::$cached = [];
    }

    /**
     * Return current all cached data
     *
     * @param   void
     * @param   array
     */
    public function dumpCache()
    {
        return static::$cached;
    }
}