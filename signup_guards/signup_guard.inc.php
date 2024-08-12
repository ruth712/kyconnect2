<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //guard 1 data
    $guardFullName = $_POST["guard_full_name"];
    $guardPwd = $_POST["guard_password"];
    $guardEmail = $_POST["guard_email"];
    $guardContactNumber = $_POST["guard_contact_number"];

    try {
        //link to a file
        require_once "dbh-inc.php"; //include gives warning, require gives error
        require_once "signup_guard_model.inc.php";
        require_once "signup_guard_contr.inc.php";

        // Error Handlers
        $errors = [];

        if (is_input_empty($guardFullName, $pwd, $guardEmail)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($guardEmail)) {
            $errors["invalid_email"] = "Invalid email used";
        }
        if (is_email_registered($pdo, $guardEmail)) {
            $errors["email_used"] = "Email already registered";
        }
        if (is_fullname_taken($pdo, $guardFullName)) {      
            $errors["username_taken"] = "Username already taken";
        }
        
        require_once "cofig_session.inc.php";

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [ //allow data to appear on screen if user submitted data with errors
                "guard_full_name" => $guardFullname,
                "guard_email" => $guardEmail,
            ];
            $_SESSION["errors_signup"] = $signupData;

            header("Location: ../.php");
        }

        create_user($pdo, $fullname, $pwd, $studentemail);

        header("Location: ../.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../.php");
}