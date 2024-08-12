<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $studentId = $_POST["student_id"];
    $outingTimeOut = $_POST["outing_time_out"];
    $outingTimeIn = $_POST["outing_time_in"];
    $guardOutId = $_POST["guard_out_id"];
    $guardInId = $_POST["guard_in_id"];

    try {
        require_once "dbh.inc.php";
        require_once "student_status_model.inc.php";
        require_once "student_status_contr.inc.php";

        // Error Handlers
        $errors = [];

        if (is_input_empty($studentId, $outingTimeIn, $outingTimeOut)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if ($errors) {
            $_SESSION["errors_status"] = $errors;
            header("Location: ../student_status.php");
            exit();
        }

        // Assuming the model function is used to insert or update student status
        set_student_status($pdo, $studentId, $outingTimeOut, $guardOutId, $outingTimeIn, $guardInId, true);

        $_SESSION['last_regeneration'] = time();
        
        header("Location: ../student_status.php?status=success");
        exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../");
}
