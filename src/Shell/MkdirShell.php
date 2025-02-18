<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use Cake\Utility\Hash;

/**
 * Mkdir shell command.
 * Create necessary directories for this system.
 */
class MkdirShell extends Shell
{
    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $paths = Hash::flatten(Configure::read('System.Paths'));

        if (empty($paths)) {
            $this->warn(__('System.Paths configuration is empty. Nothing to do.'));
            return;
        }

        $folder = new Folder();
        foreach ($paths as $path) {
            if (!Folder::isAbsolute($path)) {
                $path = ROOT.DS.ltrim($path, DS);
            }
            else if (!$this->inRootPath($path)) {
                $this->err(__('NG: {0}  Could not create directory outside ROOT', $path));
                continue;
            }
            
            if ($folder->create($path)) {
                $this->success(__('OK: {0}', $path));
            }
            else {
                $this->err(__('NG: {0}', $path));
            }
        }
    }

    /**
     * Check ROOT path is inside provided path or not
     *
     * @param   string  check path
     * @return  bool    check result
     */
    public function inRootPath($path) {
        return strpos($path, ROOT) === 0;
    }
}
