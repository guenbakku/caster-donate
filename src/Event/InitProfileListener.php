<?php
namespace App\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use App\Utility\Flysystem;
use App\Utility\File;

class InitProfileListener implements EventListenerInterface
{
    public function implementedEvents() {
        return [
            UsersAuthComponent::EVENT_AFTER_REGISTER => 'createProfileAfterUserRegister',
        ];
    }

    public function createProfileAfterUserRegister($event)
    {
        $user_id = $event->getData('user')->id;
        $profilesTb = TableRegistry::get('Profiles');

        $exists = $profilesTb->exists(['user_id' => $user_id]);

        if (!$exists) {
            $profile = [
                'user_id' => $user_id,
                'avatar' => null,
            ];

            // Copy avatar from `social_accounts` table
            $socialAccountsTb = TableRegistry::get('SocialAccounts');
            $socialAccount = $socialAccountsTb->findByUserId($user_id)->first();
            if (!empty($socialAccount->avatar)) {
                $profile['avatar'] = $this->_copyAvatarFromUrlToWebroot($socialAccount->avatar);
            }

            // Insert one record to `profiles` table
            if ($profilesTb->behaviors()->has('Upload')) {
                $profilesTb->removeBehavior('Upload');
            }
            $profile = $profilesTb->newEntity(
                $profile, 
                ['validate' => false]
            );
            $profilesTb->save($profile);
        }
    }

    /**
     * Copy avatar from social account to webroot
     *
     * @param   string: url to avatar in social account
     * @return  string|null: filename of copied avatar
     */
    protected function _copyAvatarFromUrlToWebroot(string $url)
    {
        $avatar = file_get_contents($url);

        if ($avatar === false) {
            return null;
        }

        $tmp = tempnam(sys_get_temp_dir(), 'upload');
        file_put_contents($tmp, $avatar);

        $resized = File::resizeImageTo($tmp, Configure::read('System.Dimensions.avatar'));

        $newFilename = File::uuidName($resized);
        $newFilepath = Configure::read('System.Paths.avatar_dir').$newFilename;
        $flysystem = Flysystem::getFilesystem();
        $flysystem->write($newFilepath, file_get_contents($resized));

        unlink($tmp);
        unlink($resized);

        return $newFilename;
    }
}