<?php

namespace app\traits;

use ReflectionClass;
use app\core\Language;
use app\core\Tygh;

trait LanguageTrait
{

    /**
     * language
     *
     * @var array
     */
    protected $language = [];

    
    /**
     * loadLanguage
     *
     * @return void
     */
    protected function loadLanguage()
    {
        $controllerName = $this->getControllerName();
        $files = [
            $controllerName,
            'en-gb'
        ];
        foreach ($files as $key => $value) {
            $loadedLang = Language::load(strtolower($value));
            if (is_array($loadedLang) && !empty($loadedLang)) {
                $this->language = array_merge_recursive($this->language, $loadedLang);
            }
        }
        // Make language variables accessible globally (optional)
        // $GLOBALS['language'] = $this->language;
        Tygh::assign('lang',$this->language);
    }
    
    /**
     * getControllerName
     *
     * @return string
     */
    protected function getControllerName()
    {
        // Get the name of the current controller
        return (new ReflectionClass($this))->getShortName();
    }

}