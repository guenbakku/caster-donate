<?php
namespace App\Utility;

use Cake\Filesystem\File as CakeFile;
use Cake\Utility\Text;
use MimeTyper\Repository\MimeDbRepository;

class File extends CakeFile
{
    /**
     * Return new file name in uuid format.
     * If filepath of current existing file is provided, 
     * this wil try to guest right extension from that file's content type.
     *
     * @param   string: filename or filepath
     * @return  string: new file name
     */
    public static function uuidName(string $filepath)
    {
        if (is_file($filepath)) {
            $mimeRepository = new MimeDbRepository();
            $mime_type = mime_content_type($filepath);
            $ext = $mimeRepository->findExtension($mime_type);
        } else {
            $ext = pathinfo($filepath, PATHINFO_EXTENSION);
        }
        $new_file_name = implode('.', array_filter([Text::uuid(), $ext]));
        return $new_file_name;
    }
}