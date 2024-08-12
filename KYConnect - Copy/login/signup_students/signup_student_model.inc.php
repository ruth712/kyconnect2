<?php

declare(strict_types=1);

function get_username(object $pdo, string $fullName) {
    $query = "SELECT full_name FROM students WHERE full_name = :full_name;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":full_name", $fullName);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $studentEmail) { //WRONG
    $query = "SELECT s.student_full_name, g1.guardian1_full_name, g2.guardian2_full_name
    FROM students s
    JOIN guardian_1 g1 ON s.guardian1_id = g1.guardian1_id
    JOIN guardian_2 g2 ON s.guardian2_id = g2.guardian2_id
    WHERE student_email = :student_email AND guardian1_email = :guardian1_email AND guardian2_email = :guardian2_email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":student_email", $studentEmail);
    $stmt->bindParam(":guardian1_email", $guardian1Email);
    $stmt->bindParam(":guardian2_email", $guardian2Email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo,string $fullName,string $pwd,string $studentEmail,int $contactNumber,int $studentId,string $house,string $guardian1FullName,string $guardian1Relationship,string $guardian1ContactNumber,string $guardian1Email, string $guardian2FullName,string $guardian2Relationship,string $guardian2ContactNumber,string $guardian2Email,string $block1,string $block2,string $block3,string $block4,string $block5,string $block6)
{
    //guardian1
    $query = "INSERT INTO guardian_1 (guardian1_full_name, guardian1_relationship, guardian1_contact_number, guardian1_email)
    VALUES (:guardian1_fullname, :guardian1_relationship, :guardian1_contact_number, :guardian1_email);";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":guardian1_full_name", $guardian1FullName);
    $stmt->bindParam(":guardian1_relationship", $guardian1Relationship);
    $stmt->bindParam(":guardian1_contact_number", $guardian1ContactNumber);
    $stmt->bindParam(":guardian1_email", $guardian1Email);

    $stmt->execute();

    $guardian1_id = pdo->lastInsertId();

    //guardian2
    $guardian2_id = null;
    if(!empty($guardian2FullName) && !empty($guardian2Relationship) && !empty($guardian2ContactNumber) && !empty($guardian2Email)) {
        $query = "INSERT INTO guardian_2 (guardian2_full_name, guardian2_relationship, guardian2_contact_number, guardian2_email)
        VALUES (:guardian2_full_name, :guardian2_relationship, :guardian2_contact_number, :guardian2_email);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":guardian2_full_name", $guardian2FullName);
        $stmt->bindParam(":guardian2_relationship", $guardian2Relationship);
        $stmt->bindParam(":guardian2_contact_number", $guardian2ContactNumber);
        $stmt->bindParam(":guardian2_email", $guardian2Email);

        $stmt->execute();

        $guardian2_id = pdo->lastInsertId();
    }

    //Blocks
    $query = "INSERT INTO student_blocks (block_1, block_2, block_3, block_4, block_5, block_6)
    VALUES (:block_1, :blokc_2, :block_3, :block_4, :block_5, :block_6);";

    $stmt = pdo->prepare($query);

    $stmt->bindParam(":block1", $block1);
    $stmt->bindParam(":block2", $block2);
    $stmt->bindParam(":block3", $block3);
    $stmt->bindParam(":block4", $block4);
    $stmt->bindParam(":block5", $block5);
    $stmt->bindParam(":block6", $block6);

    $stmt->execute();

    $student_blocks_id = pdo->lastInsertId();

    //students
    $query = "INSERT INTO students (full_name, pwd, student_email, contact_number, student_id, house, guardian1_id, guardian2_id, student_blocks_id)
    VALUES (:full_name, :pwd, :student_email, :contact_number, :student_id, :house, :guardian1_id, :guardian2_id, :student_blocks_id);";

    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":full_name", $fullName);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":student_email", $studentEmail);
    $stmt->bindParam(":contact_number", $contactNumber);
    $stmt->bindParam(":student_id", $studentId);
    $stmt->bindParam(":house", $house);
    $stmt->bindParam(":guardian1_id", $guardian1_id);
    $stmt->bindParam(":guardian2_id", $guardian2_id);
    $stmt->bindParam(":students_blocks_id", $students_blocks_id);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}