<?php

declare(strict_types=1);

function is_input_empty(string $fullName,string $pwd,string $studentEmail)
{
    if (empty($fullName) || empty($pwd) || empty($studentEmail)) {
        return true;
    }else {
     return false;
    }
}

function is_email_invalid(string $studentEmail) 
{
    if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $fullName) 
{
    if (get_username($pdo,$fullName)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $fullName)
{
    if (get_email($pdo,$studentEmail)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo,string $fullName,string $pwd,string $studentEmail,int $contactNumber,int $studentId,string $house,string $guardian1FullName,string $guardian1Relationship,string $guardian1ContactNumber,string $guardian1Email, string $guardian2FullName,string $guardian2Relationship,string $guardian2ContactNumber,string $guardian2Email,string $block1,string $block2,string $block3,string $block4,string $block5,string $block6){
    set_user($pdo, $fullName, $pwd, $studentEmail, $contactNumber, $studentId, $house, $guardian1FullName, $guardian1Relationship, $guardian1ContactNumber, $guardian1Email,$guardian2FullName, $guardian2Relationship, $guardian2ContactNumber, $guardian2Email, $block1, $block2, $block3, $block4, $block5, $block6);
}