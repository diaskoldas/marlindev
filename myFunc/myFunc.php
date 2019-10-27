<?php

function d($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
function delCookie($cookie_key)
{
    if (!empty($_COOKIE[$cookie_key])) {
        unset($_COOKIE[$cookie_key]);
        setcookie($cookie_key, null, -1, '/');
        return true;
    }
    return false;
}
