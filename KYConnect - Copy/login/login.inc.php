<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userRole = $_POST["user_role"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";


        // Error Handlers
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username, $role);
        if(is_username_wrong($result["username"])) {
            $errors["login_incorect"] = "Incorrect login info!";
        }
        if(!is_username_wrong($result["username"]) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorect"] = "Incorrect login info!";
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

        $_SESSION["user_id"] = $result["id"];
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