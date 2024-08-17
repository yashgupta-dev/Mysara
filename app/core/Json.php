<?php

namespace app\core;

class Json {
    
    /**
     * encode
     *
     * @param  mixed $data
     * @return json|string|array
     */
    public static function encode($data) {
        return json_encode($data);
    }
    
    /**
     * decode
     *
     * @param  mixed $data
     * @return array
     */
    public static function decode($data) {
        return json_decode($data);
    }
    
    /**
     * decode_array
     *
     * @param  mixed $data
     * @return array
     */
    public static function decode_array($data) {
        return json_decode($data,true);
    }
}