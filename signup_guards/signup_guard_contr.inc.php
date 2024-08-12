<?php

declare(strict_types=1);

function is_input_empty(string $guardFullname,string $pwd,string $guardEmail)
{
    if (empty($guardFullName) || empty($guardPwd) || empty($guardEmail)) {
        return true;
    }else {
     return false;
    }
}

function is_email_invalid(string $guardEmail) 
{
    if (!filter_var($guardEmail, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $guardFullName) 
{
    if (get_username($pdo,$guardFullName)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $guardFullName)
{
    if (get_email($pdo,$guardEmail)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $guardFullName, string $pwd, string $guardEmail, string $guardContactNumber){
    set_user($pdo, $guardFullName, $pwd, $guardEmail, $guardContactNumber);
}