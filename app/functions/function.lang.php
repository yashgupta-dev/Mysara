<?php
// Translation function
function __($key)
{
    global $language;
    return isset($language[$key]) ? $language[$key] : $key;
}
