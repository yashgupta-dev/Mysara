<?php

namespace app\core;

use app\core\Session;

class Language {
    
    
    public function __construct()
    {   
        $lan_code = Session::get('lang_code') ?? '';
        return $this->loadLanguage($lan_code = 'en-gb');
    }
    
    /**
     * loadLanguage
     *
     * @param  mixed $langCode
     * @return mix
     */
    function loadLanguage($langCode) {
        $languageFilePath = RESOURCES . 'lang/' . $langCode . '/'.$langCode.'.php';
        
        return include $languageFilePath;
    }

}

