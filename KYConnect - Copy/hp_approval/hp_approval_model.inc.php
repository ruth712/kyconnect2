<?php

function get_pending_request (object $pdo, string $outingId, string $studentId, bool $exeat, string $outingReason, string $outingDuration, string $outingDestination, string $outingTransport, string $outingApprovalStatus)
        {
            $query = "SELECT o.outing_id, o.outing_reason, o.outing_duration, o.outing_destination, o.outing_transport, s.student_full_name, s.student_id
            FROM outing o JOIN students s ON o.student_id = s.student_id
            WHERE o.outing_approval_status = 'pending' AND o.exeat = 'TRUE';";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam('outing_reason', $outingReason);
            $stmt->bindParam('outing_duration', $outingDuration);
            $stmt->bindParam('outing_destination', $outingDestination);
            $stmt->bindParam('outing_transport', $outingTransport);
            $stmt->execute();

            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

        function update_status (object $pdo,string $outingId, string $outingApprovalStatus)
        {
            $query = "UPDATE $outingApprovalStatus SET outing_approval_status = :outing_approval_status WHERE outing_id = :outing_id";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam('outing_approval_status', $outingApprovalStatus);
            $stmt->bindParam('outing_id', $outingId);
            
            $stmt->execute();
        }