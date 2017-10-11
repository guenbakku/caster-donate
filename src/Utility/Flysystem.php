<?php
namespace App\Utility;

use Cake\Core\Configure;
use Cake\Utility\Hash;

/**
 * A CakePHP wrapper of League\Flysystem
 */
class Flysystem
{
    protected static $cached = [];

    /**
     * Return filesystem object
     *
     * @param   string|null: name of adapter's group
     * @return  object: filesystem object
     */
    public static function getFilesystem(string $uses = null)
    {
        if (empty($uses)) {
            $uses = static::getDefaultUses();
        }

        $type = 'filesystem';
        $filesystem = static::readCache($uses, $type);
        if (!$filesystem) {
            $adapter = static::getAdapter($uses);
            $filesystem = new \League\Flysystem\Filesystem($adapter);
            static::writeCache($uses, $type, $filesystem);
        }
        
        return $filesystem;
    }

    /**
     * Return adapter object
     *
     * @param   string|null: name of group of adapter
     * @return  object: adapter object
     */
    public static function getAdapter(string $uses = null)
    {
        if (empty($uses)) {
            $uses = static::getDefaultUses();
        }

        $config = Configure::read('Flysystem.'.$uses);
        
        $type = 'adapter';
        $adapter = static::readCache($uses, $type);
        if (!$adapter) {
            $method = 'getAdapter_'.$config[$type];
            $adapter = static::{$method}($config);
            static::writeCache($uses, $type, $adapter);
        }
        return $adapter;
    }

    /**
     * Return name of group of adapter which is set in config file
     *
     * @param   void
     * @return  string
     */
    public static function getDefaultUses()
    {
        $uses = Configure::read('Flysystem.uses');

        if (empty($uses)) {
            throw new \InvalidArgumentException(
                'Don\'t know what adapter to use. Please check config file again.'
            );
        }

        return $uses;
    }

    /**
     * Clear cache
     *
     * @param   void
     * @return  array: cleared cache
     */
    public static function clearCache()
    {
        static::$cached = [];
        return static::$cached;
    }

    /**
     * Return Local adapter object
     *
     * @param   array: config for adapter
     * @return  object: adapter object
     */
    protected static function getAdapter_Local(array $config)
    {
        $adapter = new \League\Flysystem\Adapter\Local($config['root']);
        return $adapter;
    }

    /**
     * Return AWS-S3-V3 adapter object
     *
     * @param   array: config for adapter
     * @return  object: adapter object
     */
    protected static function getAdapter_AwsS3Adapter(array $config)
    {
        $client = \Aws\S3\S3Client::factory(Hash::get($config, 'auth'));
        $bucket = Hash::get($config, 'bucket', null);
        $prefix = Hash::get($config, 'prefix', '');
        $adapter = new \League\Flysystem\AwsS3v3\AwsS3Adapter($client, $bucket, $prefix);
        return $adapter;
    }

    /**
     * Return value get from cache
     *
     * @param   string: name of group of adapter
     * @param   string: adapter or filesystem
     * @param   mixed: cached value
     */
    protected static function readCache(string $uses, string $type)
    {
        return Hash::get(static::$cached, $uses.'.'.$type);
    }

    /**
     * Write value to cache
     *
     * @param   string: name of group of adapter
     * @param   string: adapter or filesystem
     * @param   mixed: value want to write to cache
     * @return  void
     */
    protected static function writeCache(string $uses, string $type, $value)
    {
        static::$cached = Hash::insert(static::$cached, $uses.'.'.$type, $value);
    }
}
