<?php

function d($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
function delCookie($cookie_key)
{
    if (isset($_COOKIE[$cookie_key])) {
        unset($_COOKIE[$cookie_key]);
        setcookie($cookie_key, null, -1, '/');
        return true;
    }
    return false;
}
function userNameValid($value, $min_symbol, $max_symbol)
{
    $arr = [];
    $arr['is_valid'] = false;
    if ($value == '')
    {
        $arr['message'] = 'Заполните обязательное поле';
        return $arr;
    }
    if (strlen($value) < $min_symbol)
    {
        $arr['message'] = "Количество символов не должно быть меньше $min_symbol";
        return $arr;
    }
    if (strlen($value) > $max_symbol)
    {
        $arr['message'] = "Количество символов не должно превышать $max_symbol";
        return $arr;
    }
    $arr['data'] = $value;
    $arr['is_valid'] = true;
    return $arr;
}
function messageValid($value, $min_symbol, $max_symbol)
{
    $arr = [];
    $arr['is_valid'] = false;
    if ($value == '')
    {
        $arr['message'] = 'Заполните обязательное поле';
        return $arr;
    }
    if (strlen($value) < $min_symbol)
    {
        $arr['message'] = "Количество символов не должно быть меньше $min_symbol";
        return $arr;
    }
    if (strlen($value) > $max_symbol)
    {
        $arr['message'] = "Количество символов не должно превышать $max_symbol";
        return $arr;
    }
    $arr['data'] = $value;
    $arr['is_valid'] = true;
    return $arr;
}
function emailValid($value)
{
    $arr = [];
    $arr['is_valid'] = false;

    if ($value == '')
    {
        $arr['message'] = 'Заполните обязательное поле';
        return $arr;
    }
    if (!filter_var($value, FILTER_VALIDATE_EMAIL))
    {
        $value = stripcslashes($value); // Удаляет экранирование символов
        $arr['data'] = $value;
        $arr['message'] = "E-mail адрес $value указан неверно";
        return $arr;
    }
    $arr['data'] = $value;
    $arr['is_valid'] = true;
    return $arr;
}
function passwordValid($pass_1, $pass_2)
{
    $arr = [];
    $arr['is_valid'] = false;
    if ($pass_1 == '' ||
        $pass_2 == '')
    {
        $arr['message'] = 'Заполните обязательные поля для пароля';
        return $arr;
    }
    if ($pass_1 !== $pass_2)
    {
        $arr['message'] = 'Пароли не совпадают';
        return $arr;
    }
    if (strlen($pass_1) != strlen($pass_2))
    {
        $arr['message'] = 'Пароль не совпадают';
        return $arr;
    }
    if (strlen($pass_1) == strlen($pass_2) &&
        strlen($pass_1) < 5)
    {
        $arr['message'] = 'Пароль не должен содержать менее 5-ти символов';
        return $arr;
    }
    $arr['is_valid'] = true;
    return $arr;
}
