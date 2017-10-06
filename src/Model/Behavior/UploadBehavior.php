<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Collection\Collection;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Event\Event;
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
     * Override parent's method to add feature that remove previous upload item
     *
     * @param \Cake\Event\Event $event The beforeSave event that was fired
     * @param \Cake\ORM\Entity $entity The entity that is going to be saved
     * @param \ArrayObject $options the options passed to the save method
     * @return void|false
     */
    public function beforeSave(Event $event, Entity $entity, ArrayObject $options)
    {
        $this->deletePreviousOnEdit($event->subject(), $entity);
        return parent::beforeSave($event, $entity, $options);
    }

    /**
     * Delete previous previous upload item of field
     *
     * @param   \Cake\ORM\Table
     * @param   \Cake\ORM\Entity
     * @return  void|false
     */
    public function deletePreviousOnEdit(Table $table, Entity $new_entity)
    {
        foreach ($this->config() as $field => $settings) {
            if ($settings['keepFileOnEdit'] || $new_entity->isNew()) {
                continue;
            }

            $entity = $table->findById($new_entity->id)->first();

            $dirField = Hash::get($settings, 'fields.dir', 'dir');
            if ($entity->has($dirField)) {
                $path = $entity->get($dirField);
            } else {
                $path = $this->getPathProcessor($entity, $entity->get($field), $field, $settings)->basepath();
            }

            $callback = Hash::get($settings, 'editCallback', null);
            if ($callback && is_callable($callback)) {
                $files = $callback($path, $entity, $field, $settings);
            } else {
                $files = [$path . $entity->get($field)];
            }

            $writer = $this->getWriter($entity, [], $field, $settings);
            $success = $writer->delete($files);
        }
    }

    /**
     * Return default config
     *
     * @param   void
     * @return  array
     */
    public function getDefaultConfig()
    {
        return [
            'filesystem' => [
                'adapter' => function () {return Flysystem::getAdapter();},
            ],
            // A hack to implement removing old file feature
            'transformer' =>  function ($table, $entity, $data, $field, $settings) {
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
