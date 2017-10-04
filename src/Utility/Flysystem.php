<?php
namespace App\Utility;

use Cake\Core\Configure;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

/**
 * A CakePHP wrapper of League\Flysystem
 */
class Flysystem
{
    protected static $cached = [];
    protected static $uses = null;

    /**
     * This magic is used for calling methods of flysystem object
     */
    public static function __callStatic($name, $args)
    {
        $filesystem = static::getFileSystem();
        $filesystem->$name(...$args);
    }

    /**
     * I don't know why __callStatic isn't invoked for has() method.
     * so I must create one has() method explicitly here.
     */
    public static function has(...$args)
    {
        $filesystem = static::getFileSystem();
        return $filesystem->has(...$args);
    }

    /**
     * Return filesystem object
     *
     * @param   string|null: name of adapter's group
     * @return  object: filesystem object
     */
    public static function getFileSystem(string $uses = null)
    {
        if (!isset(static::$cached[static::$uses])) {
            $adapter = static::getAdapter($uses);
            $filesystem = new Filesystem($adapter);
            static::$cached[static::$uses]['filesystem'] = $filesystem;
        }

        return static::$cached[static::$uses]['filesystem'];
    }

    /**
     * Return adapter object
     *
     * @param   string|null: name of adapter's group
     * @return  object: adapter object
     */
    public static function getAdapter(string $uses = null)
    {
        if (empty($uses)) {
            $uses = Configure::read('Flysystem.uses');
        }

        if (empty($uses)) {
            throw new \InvalidArgumentException('Don\'t know what adapter to use');
        }

        static::$uses = $uses;
        $config = Configure::read('Flysystem.'.$uses);
        
        if (!isset(static::$cached[$uses])) {
            $method = 'get'.$config['adapter'];
            static::$cached[$uses]['adapter'] = static::{$method}($config);
        }
        return static::$cached[$uses]['adapter'];
    }

    /**
     * Return Local adapter object
     *
     * @param   array: config for Local adapter
     * @return  object: adapter object
     */
    protected static function getLocal(array $config)
    {
        $adapter = new Local($config['root']);
        return $adapter;
    }
}
