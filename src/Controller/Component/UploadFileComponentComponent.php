<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * UploadFileComponent component
 */
class UploadFileComponentComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function uploadFile ($file = null, $relative_dir = null, $limitFileSize = null, $allowFileTypes = []){
        $result_array = [
            'error' => true,
            'error_message' => __('Lỗi chưa xác định'),
            'file_name' => '',
            'file_absolute_path' => '',
            'file_relative_path' => '',
        ];
        // kiểm tra folder lưu file
        if ($relative_dir != null)
        {
            $absolute_dir = realpath(WWW_ROOT.$relative_dir);
            if(!file_exists($absolute_dir))
            {
                $result_array['error_message'] = __('Folder không tồn tại');
                return $result_array;
            }
        } else {
            $result_array['error_message'] = __('Folder chưa được chỉ định');
            return $result_array;
        }

        // Kiểm tra lỗi
        if (!isset($file['error']) || is_array($file['error'])){
            $result_array['error_message'] = __('Tham số không đúng.');
            return $result_array;
        }
        switch ($file['error']) {
            case 0:
                break;
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $result_array['error_message'] = __('Không có file được gửi.');
                return $result_array;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $result_array['error_message'] = __('Dung lượng file quá lớn.');//dung lượng thiết lập trong php.ini
                return $result_array;
            default:
                return $result_array;
        }

        // lấy thông tin file
        $fileInfo = new File($file["tmp_name"]);

        // kiểm tra dung lượng file qua biến được gửi đến
        if(is_numeric($limitFileSize))
        {
            if ($fileInfo->size() > $limitFileSize)
            {
                $result_array['error_message'] = __('Dung lượng file lớn hơn dung lượng cho phép.');
                return $result_array;
            }
        }

        // Kiểm tra type file
        if(!empty($allowFileTypes))
        {
            if (false === $ext = array_search($fileInfo->mime(), $allowFileTypes, true))
            {
                $result_array['error_message'] = __('File sai định dạng.');
                return $result_array;
            }
        }
        

        //Tạo và lưu file
        $uploadFile = sha1_file($file["tmp_name"]) . "." . $ext;
        if (!@move_uploaded_file($file["tmp_name"], $absolute_dir . "/" . $uploadFile)){
            $result_array['error_message'] = __('Không thể chuyển file đến nơi chỉ định.');
            return $result_array;
        }

        $result_array['error'] = false;
        $result_array['file_name'] = $uploadFile;
        $result_array['file_absolute_path'] = $absolute_dir.'/'.$uploadFile;
        $result_array['file_relative_path'] = $relative_dir.'/'.$uploadFile;
        return $result_array;
    }
}
