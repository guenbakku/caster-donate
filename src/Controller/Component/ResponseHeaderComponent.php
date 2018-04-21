<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;

/**
 * Auto emit specific headers to response.
 */
class ResponseHeaderComponent extends Component
{
    protected $_defaultConfig = [
        'headers' => [],
        'excludes' => [],
    ];

    /**
     * List of headers in config.headers that are not want to be emited to response.
     * This list does not affect the headers which are set directly by $response->withHeader().
     */
    protected $excludes = [];

    /**
     * Emit pre-set headers to response
     *
     * @param   Event
     * @return  void
     */
    public function shutdown(Event $event)
    {
        $this->exclude($this->getConfig('excludes'));
        $controller = $this->getController();
        $headers = $this->getConfig('headers');

        foreach ($headers as $header => $value) {
            if ($controller->response->hasHeader($header)) {
                continue;
            }
            if ($this->isExcluded($header)) {
                continue;
            }

            $controller->response = $controller->response->withHeader($header, $value);
        }
    }

    /**
     * Exclude specific headers from emiting to response
     *
     * @param   array: list of headers
     * @return  void
     */
    public function exclude(array $headers)
    {
        foreach ($headers as $header) {
            $this->excludes[strtolower($header)] = true;
        }
    }

    /**
     * Check if a header is in excluded list
     *
     * @param   string
     * @return  bool
     */
    public function isExcluded(string $header)
    {
        return isset($this->excludes['*']) || isset($this->excludes[strtolower($header)]);
    }
}