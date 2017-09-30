<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Utility\Text;
use Cake\Utility\Hash;
use MimeTyper\Repository\MimeDbRepository;

/**
 * Upload behavior.
 * NOTE: this method does not validate input data.
 */
class UploadBehavior extends Behavior
{
    /**
     * Move upload file to right place
     *
     * @param   array   move info
     *      [
     *          'id' => record_id,
     *          'uploaded' => uploaded file info (php default format)
     *          'to' => path to move file to,
     *          'field' => column to save file name to,
     *      ],...
     * @return  array|null    new filename if success or null if fail
     */
    public function moveUploadedFile(array $info)
    {
        if (Hash::get($info, 'uploaded.error') !== UPLOAD_ERR_OK) {
            return null;
        }

        $from = $info['uploaded']['tmp_name'];
        $new_file_name = $this->newFileName($from);
        $to = rtrim($info['to'], DS) . DS . $new_file_name;
        move_uploaded_file($from, $to);
        
        return empty($info['field'])
                ? [basename($to)]
                : [$info['field'] => basename($to)];
    }

    /**
     * Move upload file to right place and save new file name to database
     *
     * @param   array   move info
     *      [
     *          'id' => record_id,
     *          'uploaded' => uploaded file info (php default format)
     *          'to' => path to move file to,
     *          'field' => column to save file name to,
     *      ],...
     * @return  array|null    new filename if success or null if fail
     */
    public function moveUploadedFileAndSave(array $info) {
        $new_file_name = $this->moveUploadedFile($info);

        if (empty($new_file_name)) {
            return null;
        }

        $entity = $this->_table->findById($info['id'])->first();
        if (empty($entity)) {
            $entity = $this->_table->newEntity();
        }

        $old_file_name = $entity->{$info['field']};

        // Update new file name
        $entity->id = $info['id'];
        $entity = $this->_table->patchEntity($entity, $new_file_name, ['validate' => false]);
        $this->_table->save($entity);

        // Delete old file
        if (!empty($old_file_name)) {
            $old_file_path = rtrim($info['to'], DS) . DS . $old_file_name;
            if (is_file($old_file_path)) {
                unlink($old_file_path);
            }
        }

        return $new_file_name;
    }

    protected function newFileName(string $filepath)
    {
        $mimeRepository = new MimeDbRepository();
        
        $mime_type = mime_content_type($filepath);
        $ext = $mimeRepository->findExtension($mime_type);

        $new_file_name = implode('.', array_filter([Text::uuid(), $ext]));
        return $new_file_name;
    }
}
