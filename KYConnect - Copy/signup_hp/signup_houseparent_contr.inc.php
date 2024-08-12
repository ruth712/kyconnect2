<?php

declare(strict_types=1);

function is_input_empty(string $hpFullName,string $pwd,string $hpEmail)
{
    if (empty($hpFullName) || empty($pwd) || empty($hpEmail)) {
        return true;
    }else {
     return false;
    }
}

function is_email_invalid(string $hpEmail) 
{
    if (!filter_var($hpEmail, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $hpFullName) 
{
    if (get_username($pdo,$hpFullName)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $hpEmail)
{
    if (get_email($pdo,$hpEmail)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $hpFullName, string $pwd, string $hpEmail, string $hpContactNumber, string $house){
    set_user($pdo, $hpFullName, $pwd, $hpEmail, $hpContactNumber, $house);
}