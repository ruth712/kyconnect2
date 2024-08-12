<?php

declare(strict_types=1);

function set_student_status(object $pdo, int $studentId, string $outingTimeOut, int $guardOutId, ?string $outingTimeIn, ?int $guardInId, bool $onCampus)
{
    $query = "INSERT INTO student_status (student_id, outing_time_out, guard_out_id, outing_time_in, guard_in_id, on_campus)
              VALUES (:student_id, :outing_time_out, :guard_out_id, :outing_time_in, :guard_in_id, :on_campus)";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":student_id", $studentId);
    $stmt->bindParam(":outing_time_out", $outingTimeOut);
    $stmt->bindParam(":guard_out_id", $guardOutId);
    $stmt->bindParam(":outing_time_in", $outingTimeIn);
    $stmt->bindParam(":guard_in_id", $guardInId);
    $stmt->bindParam(":on_campus", $onCampus);
    $stmt->execute();
}

function update_student_status(object $pdo, int $studentId, string $outingTimeIn, int $guardInId, bool $onCampus)
{
    $query = "UPDATE student_status SET outing_time_in = :outing_time_in, guard_in_id = :guard_in_id, on_campus = :on_campus 
              WHERE student_id = :student_id";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':student_id', $studentId);
    $stmt->bindParam(':outing_time_in', $outingTimeIn);
    $stmt->bindParam(':guard_in_id', $guardInId);
    $stmt->bindParam(':on_campus', $onCampus);
    $stmt->execute();
}
