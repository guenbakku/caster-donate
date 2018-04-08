<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use App\Utility\Flysystem;

/**
 * Embed asset content (image, css, js) into HTML tag
 */
class EmbedAssetHelper extends Helper
{
    use StringTemplateTrait;

    protected $_defaultConfig = [
        'templates' => [
            'image' => '<img src="{{url}}"{{attrs}}/>',
            'style' => '<style{{attrs}}>{{content}}</style>',
            'javascriptblock' => '<script{{attrs}}>{{content}}</script>',
        ],
        'filesystem' => [
            'adapter' => null,
        ]
    ];

    /**
     * Create a formatted image element with embed content in src attribute.
     * @param string $path Path to the image file, absolute path in file system.
     * @param array $options Array of HTML attributes. Same with CakePHP HtmlHelper.
     */
    public function image(string $path, array $options = [])
    {   
        $filesystem = $this->getFilesystem();
        if (!$filesystem->has($path)) {
            throw new \InvalidArgumentException(sprintf('Could not find file %s.', $path));
        }

        $mime_type = $filesystem->getMimetype($path);
        $content = base64_encode($filesystem->read($path));
        $content = 'data:'.$mime_type.';base64,'.$content;

        $templater = $this->templater();
        $tag = $templater->format('image', [
            'url' => $content,
            'attrs' => $templater->formatAttributes($options),
        ]);

        return $tag;
    }

    /**
     * Create a formatted style element with embed content inside.
     * @param string $path Path to the image file, absolute path in file system.
     * @param array $options Array of HTML attributes. Same with CakePHP HtmlHelper.
     */
    public function css(string $path, array $options = [])
    {
        $filesystem = $this->getFilesystem();
        if (!$filesystem->has($path)) {
            throw new \InvalidArgumentException(sprintf('Could not find file %s.', $path));
        }

        $content = $filesystem->read($path);

        $templater = $this->templater();
        $tag = $templater->format('style', [
            'content' => $content,
            'attrs' => $templater->formatAttributes($options),
        ]);

        return $tag;
    }

    /**
     * Create a formatted script element with embed content inside.
     * @param string $path Path to the image file, absolute path in file system.
     * @param array $options Array of HTML attributes. Same with CakePHP HtmlHelper.
     */
    public function script(string $path, array $options = [])
    {
        $filesystem = $this->getFilesystem();
        if (!$filesystem->has($path)) {
            throw new \InvalidArgumentException(sprintf('Could not find file %s.', $path));
        }

        $content = $filesystem->read($path);

        $templater = $this->templater();
        $tag = $templater->format('javascriptblock', [
            'content' => $content,
            'attrs' => $templater->formatAttributes($options),
        ]);

        return $tag;
    }

    protected function getFilesystem() {
        $adapter = $this->getConfig('filesystem.adapter');
        if (!$adapter instanceof AdapterInterface) {
            if (is_callable($adapter)) {
                $adapter = $adapter();
            } else {
                $adapter = Flysystem::getAdapter();
            }
        }

        return new Filesystem($adapter, $this->getConfig('filesystem.options', [
            'visibility' => AdapterInterface::VISIBILITY_PUBLIC
        ]));
    }
}
