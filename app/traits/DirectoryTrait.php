<?php

namespace app\traits;

trait DirectoryTrait
{

    protected function fileExists($dir, $files, $extension = '') {
        foreach ($this->getFiles($dir.'*') as $key => $value) {
            if(strtolower($value) === strtolower($dir.$files.$extension)) {
                return $value;
            }
        }
        return false;
    }
    
    /**
     * getFiles
     *
     * @param  mixed $pattern
     * @return array
     */
    protected function getFiles($pattern)
    {
        $files = glob($pattern, $flags = 0);
        foreach (glob($pattern) as $dir) {
            $files = array_merge($files, $this->getFiles($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

}