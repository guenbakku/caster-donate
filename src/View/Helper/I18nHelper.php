<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\I18n\I18n;

/**
 * I18n helper
 */
class I18nHelper extends Helper
{
    /**
     * Proxy for accessing to I18n class' methods.
     * 
     * @param   string: method (must in camelCase)
     * @param   array: first item contain path to value in session
     */
    public function __call($name, $args)
    {
        return I18n::{$name}(...$args);
    }

    /**
     * Return language code (2 first letters) of current locale string.
     * This assumes that locale is in language_region combined format.
     * Language designators uses ISO 639-1, and region designators uses ISO 3166-1 standard.
     *
     * @param   void
     * @return  string
     */
    public function language()
    {
        $locale = I18n::getLocale();
        return substr($locale, 0, 2);
    }
}
