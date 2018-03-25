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

    /**
     * Resize image to $resizeTo size.
     *
     * @param   string: path to input image
     * @param   array: size [width, height] want to resize to
     * @param   bool: keep ratio or not
     * @return  string: path to output image
     */
    public static function resizeImageTo(
        string $path, 
        array $resizeTo, 
        bool $keepRatio = false
    ) {
        $extension = pathinfo(File::uuidName($path), PATHINFO_EXTENSION);
        $tmp = tempnam(sys_get_temp_dir(), 'upload');
        unlink($tmp);
        $tmp = $tmp.'.'.$extension;

        $mode = $keepRatio
            ? \Imagine\Image\ImageInterface::THUMBNAIL_INSET
            : \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        $size = new \Imagine\Image\Box(...$resizeTo);
        $imagine = new \Imagine\Gd\Imagine();

        // Save that modified file to our temp file
        $imagine->open($path)
            ->thumbnail($size, $mode)
            ->save($tmp);

        return $tmp;
    }
}