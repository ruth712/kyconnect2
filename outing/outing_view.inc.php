<?php

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<td>" . $row['student_id'] . "</td>";
    echo "<td>" . $row['outing_reason'] . "</td>";
    echo "<td>" . $row['outing_duration'] . "</td>";
    echo "<td>" . $row['outing_destination'] . "</td>";
    echo "<td>" . $row['outing_transport'] . "</td>";
}
