<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

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
        ]
    ];

    /**
     * Create a formatted image element with embed content in src attribute.
     * @param string $path Path to the image file, absolute path in file system.
     * @param array $options Array of HTML attributes. Same with CakePHP HtmlHelper.
     */
    public function image(string $path, array $options = [])
    {
        if (!is_file($path)) {
            throw new \InvalidArgumentException('Could not find image file.');
        }

        $mime_type = mime_content_type($path);
        $content = base64_encode(file_get_contents($path));
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
        if (!is_file($path)) {
            throw new \InvalidArgumentException('Could not find css file.');
        }

        $content = file_get_contents($path);

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
         if (!is_file($path)) {
             throw new \InvalidArgumentException('Could not find script file.');
         }
 
         $content = file_get_contents($path);
 
         $templater = $this->templater();
         $tag = $templater->format('javascriptblock', [
             'content' => $content,
             'attrs' => $templater->formatAttributes($options),
         ]);
 
         return $tag;
     }
}
