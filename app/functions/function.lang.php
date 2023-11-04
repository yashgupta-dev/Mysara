<?php
/* The `__` function is a custom function that is used for language translation. It takes a
key as input and returns the corresponding translation from the `` array. If the
translation is not found, it returns the key itself. */

function __($key)
{
    global $language;
    return isset($language[$key]) ? $language[$key] : $key;
}
