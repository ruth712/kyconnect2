<?php

function show_student_status($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['student_full_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['outing_time_out']) . "</td>";
        echo "<td>" . htmlspecialchars($row['guard_out_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['outing_time_in']) . "</td>";
        echo "<td>" . htmlspecialchars($row['guard_in_name']) . "</td>";
        echo "</tr>";
    }
}
