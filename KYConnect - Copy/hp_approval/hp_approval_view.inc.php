<?php

function show_pending_request($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['outing_reason']) . "</td>";
        echo "<td>" . htmlspecialchars($row['outing_duration']) . "</td>";
        echo "<td>" . htmlspecialchars($row['outing_destination']) . "</td>";
        echo "<td>" . htmlspecialchars($row['outing_transport']) . "</td>";
    }
}