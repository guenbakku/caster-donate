<?php
namespace App\Controller\Component;

use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Hash;

/**
 * Listener for logging input of all controllers
 */
class ReAuthenticateComponent extends Component
{
    protected $_defaultConfig = [
        'bindActions' => [],
        'reAuthenticateRedirect' => [
            'plugin' => false,
            'prefix' => false,
            'controller' => 'ReAuthenticate',
            'action' => 'confirm',
        ],
        'session' => [
            'key' => 'Reauthenticate',
            'timeout' => 1800, // seconds
        ],
        'keys' => [
            'redirect' => 'redirect',
            'sessionExpires' => 'expires',
        ],
    ];

    /**
     * Auto trigger after Controller::beforeFilter()
     *
     * @param   Event: event
     * @return  void
     */
    public function startup(Event $event)
    {
        if (!$this->isBindingAction()) {
            return true;
        }

        if (!$this->isSessionExpired()) {
            return true;
        }
     
        $Controller = $this->getController();
        $here = $Controller->request->here();
        return $Controller->redirect(
            $this->getConfig('reAuthenticateRedirect') + [
                '?' => [
                    $this->getConfig('keys.redirect') => $here,
                ]
            ]
        );
    }

    /**
     * Verify re-authenticate session
     */
    public function isSessionExpired()
    {
        $Controller = $this->getController();
        $expires = $Controller->request->session()->read(
            implode('.', [
                $this->getConfig('session.key'),
                $this->getConfig('keys.sessionExpires')
            ])
        );

        if (empty($expires)) {
            return true;
        }

        return $expires < Time::now();
    }

    /**
     * Check if current action is a bindingAction or not
     *
     * @param   void
     * @return  bool
     */
    public function isBindingAction()
    {
        $Controller = $this->getController();
        return in_array($Controller->request->action, $this->getConfig('bindActions'));
    }

    /**
     * Set session
     *
     * @param   void
     * @return  void
     */
    public function setSession()
    {
        $sessionKey = $this->getConfig('session.key');
        $timeout = $this->getConfig('session.timeout');

        $expires = Time::now();
        $expires->add(new \DateInterval("PT{$timeout}S"));
        $this->getController()->session()->write(
            $sessionKey, 
            [$this->ReAuthenticate->getConfig('keys.sessionExpires') => $expires]
        );
    }
}