<?php

declare(strict_types=1);

function create_outing_request (object $pdo, string $studentId, bool $exeat, string $outingReason, string $outingDuration, string $outingDestination, string $outingTransport)
{

    $query = "INSERT INTO outing (student_id, exeat, outing_reason, outing_duration, outing_destination, outing_transport, outing_approval_status)
    VALUES (:student_id, :exeat, :outing_reason, :outing_duration, :outing_destination, :outing_transport, 'pending');";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':student_id', $studentId);
    $stmt->bindParam(':exeat', $exeat);
    $stmt->bindParam(':outing_reason', $outingReason);
    $stmt->bindParam(':outing_duration', $outingDuration);
    $stmt->bindParam(':outing_destination', $outingDestination);
    $stmt->bindParam(':outing_transport', $outingTransport);

    $stmt->execute();
}

function Show_outing_result (object $pdo,string $outingId,string $outingApprovalStatus)
{
    $query = "SELECT * FROM outing WHERE outing_id = :outing_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('outing_id', $outingId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function delete_request(object $pdo, string $outing_id)
{
    $query = "DELETE FROM outing WHERE outing_id = :outing_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':outing_id', $outingId);
    $stmt->execute();
}