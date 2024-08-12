<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //student data
    $hpFullName = $_POST["hp_full_name"];
    $pwd = $_POST["pwd"];
    $hpEmail = $_POST["hp_email"];
    $hpContactNumber = $_POST["hp_contact_number"];
    $house = $_POST["house"];

    try {
        //link to a file
        require_once "dbh-inc.php"; //include gives warning, require gives error
        require_once "signup_houseparent_model.inc.php";
        require_once "signup_houseparent_contr.inc.php";

        // Error Handlers
        $errors = [];

        if (is_input_empty($hpFullName, $pwd, $hpEmail)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($hpEmail)) {
            $errors["invalid_email"] = "Invalid email used";
        }
        if (is_email_registered($pdo, $hpEmail)) {
            $errors["email_used"] = "Email already registered";
        }
        if (is_fullname_taken($pdo, $hpFullName)) {      
            $errors["username_taken"] = "Username already taken";
        }
        

        require_once "cofig_session.inc.php";

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [ //allow data to appear on screen if user submitted data with errors
                "fullname" => $hpFullName,
                "studentemail" => $hpEmail,
            ];
            $_SESSION["errors_signup"] = $signupData;

            header("Location: ../.php");
        }

        create_user($pdo, $hpFullName, $pwd, $hpEmail, $house);

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