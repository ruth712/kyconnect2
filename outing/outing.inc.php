<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $outingReason = $_POST["outing_reason"];
    $outingDuration = $_POST["outing_duration"];
    $outingDestination = $_POST["outing_destination"];
    $outingTransport = $_POST["outing_transport"];

    try {
        require_once "dbh.inc.php";
        require_once "outing_model.inc.php";
        require_once "outing_status_contr.inc.php";

        // Error Handlers
        $errors = [];

        if (is_input_empty($exeat, $outingReason, $outingDuration, $outingdestination, $outingTransport)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        require_once "cofig_session.inc.php";

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"]; //something wrong here i guess :/
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION['last_regeneration'] = time();
        
        header("Location: ../?login=success");

        $pdo = null;
        $statement = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../");
}