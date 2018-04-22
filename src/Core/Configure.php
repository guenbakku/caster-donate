<?php

namespace App\Core;

use Cake\Filesystem\Folder;
use Cake\Core\Exception\Exception;

/**
 * Extends Cake\Core\Configure to add method loadDir()
 */
class Configure extends \Cake\Core\Configure
{
    protected static $base = CONFIG;
    
    /**
     * Load all config files in provided directory
     *
     * @param   string: dir path (relative to config directory)
     * @param   string: loader name
     * @return  void
     */
    public static function loadDir(string $path, string $config = 'default')
    {
        $path = rtrim($path, DS).DS;
        $absPath = static::absPath($path);
        $filenames = static::getFilenames($absPath);
        foreach ($filenames as $filename) {
            static::load($path.$filename, $config);
        }
    }

    /**
     * Get list of filenames (except extension) in provided path
     *
     * @param   string: absolute dir path
     * @return  array
     */
    protected static function getFilenames(string $absPath)
    {
        if (!is_dir($absPath)) {
            throw new Exception('Could not load configuration directory: '.$absPath);
        }

        $dir = new Folder($absPath);
        $filenames = $dir->find('.*');

        // Remove extension from filename
        $filenames = array_map(function ($filename) {
            return pathinfo($filename, PATHINFO_FILENAME);
        }, $filenames);

        return $filenames;
    }

    /**
     * Generate absolute path to sub directory in config directory
     *
     * @param   string: dir path (relative to config directory)
     * @return  string: absolute path
     */
    protected static function absPath(string $path)
    {
        return static::$base.$path;
    }
}