<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Utility\Text;
use Cake\Utility\Hash;
use App\Utility\File;
use App\Utility\Flysystem;

/**
 * Upload behavior.
 * NOTE: this method does not validate input data.
 */
class UploadBehavior extends \Josegonzalez\Upload\Model\Behavior\UploadBehavior
{
    /**
     * Set default config which fits almost tasks in this current system
     *
     * @param array $config The config for this behavior.
     * @return void
     */
    public function initialize(array $config)
    {
        $default = $this->getDefaultConfig();
        $configs = [];
        foreach ($config as $field => $settings) {
            if (is_int($field)) {
                $configs[$settings] = $default;
            } else {
                $settings = array_merge($default, $settings);
                $configs[$field] = $settings;
            }
        }

        parent::initialize($configs);
    }

    /**
     * Return default config
     *
     * @param   void
     * @return  array
     */
    public function getDefaultConfig() {
        return [
            'filesystem' => [
                'adapter' => function () {return Flysystem::getAdapter();},
            ],
            // A hack to implement removing old file feature
            'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                // Remove old file
                $settings['editCallback']($table, $entity, $data, $field, $settings);
                
                // Resize image
                $tmp = $settings['resizer']($data['tmp_name'], $settings['resizeTo']);

                // Now return the original *and* the thumbnail
                return [
                    $tmp => $data['name'],
                ];
            },
            'nameCallback' => function ($data, $settings) {
                return File::uuidName($data['name']);
            },
            'deleteCallback' => function ($path, $entity, $field, $settings) {
                return [
                    $path . $entity->{$field},
                ];
            },
            'editCallback' => function ($table, $entity, $data, $field, $settings) {
                if (!$entity->isNew() && !$settings['keepFileOnEdit']) {
                    $entity = $table->findById($entity->id)->select($field)->first();
                    $path = $this->getPathProcessor($entity, $data, $field, $settings);
                    $old_file_path = $path->basepath().$entity->$field;
                    if (Flysystem::getFileSystem()->has($old_file_path)) {
                        Flysystem::getFileSystem()->delete($old_file_path);
                    }
                }
            },
            'resizer' => function ($path, $resizeTo) {
                $extension = pathinfo(File::uuidName($path), PATHINFO_EXTENSION);
                $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                $size = new \Imagine\Image\Box(...$resizeTo);
                $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
                $imagine = new \Imagine\Gd\Imagine();

                // Save that modified file to our temp file
                $imagine->open($path)
                    ->thumbnail($size, $mode)
                    ->save($tmp);

                return $tmp;
            },
            'keepFileOnEdit' => true,
            'keepFilesOnDelete' => true,
            'resizeTo' => [300, 300],
        ];
    }
}
