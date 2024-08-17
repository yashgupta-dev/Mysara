<?php

namespace app\core;

class Response
{

    /**
     * render
     *
     * @var bool
     */
    private $render = false;

    /**
     * json
     *
     * @param  mixed $data
     * @return string
     */
    public static function json($data)
    {
        echo $data;
        exit;
    }

    public static function view($template)
    {
        $file = RESOURCES . strtolower($template);
        if (file_exists($file)) {
            return self::$render = $file;
        }

        return false;
    }
    
    /**
     * codegenerate
     *
     * @param  mixed $length
     * @return string
     */
    public static function codegenerate($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }
}
