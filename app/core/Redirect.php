<?php

namespace app\core;

class Redirect {
        
    /**
     * encode
     *
     * @param  mixed $data
     * @return json|string|array
     */
    public static function url($url) {
        header("Location:/".$url);
    }

}