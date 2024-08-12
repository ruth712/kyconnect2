<?php

declare(strict_types=1);

function get_username(object $pdo, string $guardFullName) {
    $query = "SELECT guard_full_name FROM guards WHERE guard_full_name = :guard_full_name;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":guard_full_name", $guardFullName);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $guardEmail) {
    $query = "SELECT full_name
    FROM guards
    WHERE guard_email = :guard_email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":guard_email", $guardEmail);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user($pdo, $guardFullName, $guardPwd, $guardEmail, $guardContactNumber) {
    $query = "INSERT INTO students (guard_full_name, guard_pwd, guard_email, guard_contact_number)
    VALUES (:guard_full_name, :guard_pwd, :guard_email, :guard_contact_number);";

    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($guardPwd, PASSWORD_BCRYPT, $options);
    
    $stmt->bindParam(":guar_full_name", $guardFullName);
    $stmt->bindParam(":hashedPwd", $hashedPwd);
    $stmt->bindParam(":guard_email", $guardEmail);
    $stmt->bindParam(":guard_contact_number", $guardContactNumber);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}