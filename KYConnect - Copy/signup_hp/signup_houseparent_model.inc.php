<?php

declare(strict_types=1);

function get_username(object $pdo, string $hpFullName) {
    $query = "SELECT hp_full_name FROM houseparents WHERE hp_full_name = :hp_full_name;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":hp_full_name", $hpFullName);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $hpEmail) {
    $query = "SELECT hp_full_name
    FROM houseparents
    WHERE hp_email = :hp_email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":hp_email", $hpEmail);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user($pdo, $hpFullName, $pwd, $hpEmail, $hpContactNumber, $house) {
    $query = "INSERT INTO houseparents (hp_full_name, pwd, hp_email, hp_contact_number, house)
    VALUES (:hp_full_name, :pwd, :hp_email, :hp_contact_number, :house);";

    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    
    $stmt->bindParam(":hp_full_name", $hpFullName);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":hp_email", $hpEmail);
    $stmt->bindParam(":hp_contact_number", $hpContactNumber);
    $stmt->bindParam(":house", $house);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}