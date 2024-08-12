<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $houseparentApprovalStatus = $_POST["houseparent_approval_status"];

    try {
        require_once "dbh.inc.php";
        require_once "hp_approval_model.inc.php";
        require_once "hp_approval_contr.inc.php";

        // Error Handlers
        $errors = [];

        // Example error check
        if (empty($houseparentApprovalStatus)) {
            $errors[] = "Approval status is required.";
        }

        if ($errors) {
            $_SESSION["errors_approval"] = $errors;
            header("Location: ../hp_approval.php"); // Redirect to the appropriate page
            exit();
        }

        $outingRequests = get_pending_request($pdo);
        // Loop through pending requests and update the status
        foreach ($outingRequests as $request) {
            update_status($pdo, $request['outing_id'], $houseparentApprovalStatus);
        }

        $_SESSION['last_regeneration'] = time();
        
        header("Location: ../hp_approval.php?status=success"); // Redirect to the appropriate page
        exit();
        
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../hp_approval.php"); // Redirect to the appropriate page
    exit();
}
