<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Collection\Collection;
use Cake\Core\Configure;
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
        $this->deletePreviousOnEdit($event, $entity);
        $result = parent::beforeSave($event, $entity, $options);
        return $result;
    }

    /**
     * Delete previous previous upload item of field
     *
     * @param   \Cake\Event\Event
     * @param   \Cake\ORM\Entity
     * @return  void|false
     */
    public function deletePreviousOnEdit(Event $event, Entity $entity)
    {
        $table = $event->getSubject();

        foreach ($this->config() as $field => $settings) {
            if (Hash::get((array)$entity->get($field), 'error') !== UPLOAD_ERR_OK
                || $entity->isNew()
                || $settings['keepFileOnEdit']) 
            {   
                continue;
            }

            $entity = $table->findById($entity->id)->first();
            if (!$entity || !$entity->get($field)) {
                continue;
            }

            return $this->deleteFiles($entity, $field, $settings);
        }
    }

    /**
     * Delete uploaded file of provided field of provided record then empty that field
     *
     * @param   mixed: record id
     * @param   string: field name
     * @param   mixed: value set to field when empty it (default: null)
     * @return  void
     */
    public function deleteUploadField($id, $field, $emptyVal = null)
    {
        $settings = $this->config($field);
        $restoreValueOnFailure = Hash::get($settings, 'restoreValueOnFailure', true);

        $table = $this->_table;
        $entity = $table->findById($id)->first();
        if (!$entity || !$entity->get($field)) {
            return true;
        }

        if (!$this->deleteFiles($entity, $field, $settings)) {
            return false;
        }
        
        $this->setConfig($field.'.restoreValueOnFailure', false);
        $entity->set($field, $emptyVal);
        $result = $table->save($entity);
        $this->setConfig($field.'.restoreValueOnFailure', $restoreValueOnFailure);
        return $result;
    }

    /**
     * Delete uploaded files
     *
     * @param   \Cake\ORM\Entity
     * @param   string: field name
     * @param   array: settings
     * @return  bool: deleted result
     */
    protected function deleteFiles($entity, $field, $settings)
    {
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

        if ((new Collection($success))->contains(false)) {
            return false;
        }
        
        return true;
    }

    /**
     * Return default config
     *
     * @param   void
     * @return  array
     */
    protected function getDefaultConfig()
    {
        return [
            'filesystem' => [
                'adapter' => function () {return Flysystem::getAdapter();},
            ],
            // A hack to implement feature that removes old file
            'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                // Resize image
                $tmp = $settings['resizer']($data['tmp_name'], $settings['resizeTo'],$settings['keepRatio']);

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
            'resizer' => function ($path, $resizeTo, $keepRatio) {
                return File::resizeImageTo($path, $resizeTo, $keepRatio);
            },
            'keepFileOnEdit' => true,
            'keepFilesOnDelete' => true,
            'resizeTo' => Configure::read('System.Dimensions.avatar'),
            'keepRatio' => false,
        ];
    }
}
