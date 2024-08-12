<?php

declare(strict_types=1);

function get_user (object $pdo,string $username, string $role)
{
    //creating table &columns to check inputs based on respective roles
    $table = "";
    $usernameColumn = "";
    $user_id = "";
    $pwdColumn = "";

    switch($role){
        case "student":
            $table = "students";
            $usernameColumn = "full_name";
            $user_id = "id";
            $pwdColumn = "pwd";
            break;
        case "teachers":
            $table = "teacher";
            $usernameColumn = "teacher_full_name";
            $user_id = "teacher_id";
            $pwdColumn = "pwd";
            break;
        case "houseparent":
            $table = "houseparents";
            $usernameColumn = "houseparent_full_name";
            $user_id = "houseparent_id";
            $pwdColumn = "pwd";
            break;
        case "guard":
            $table = "guards";
            $usernameColumn = "guard_full_name";
            $user_id = "guard_id";
            $pwdColumn = "pwd";
            break;
        default :
            throw new Exception("Invalid role specified");
    }

    $query = "SELECT * FROM $table WHERE $usernameColumn = :username AND $user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}