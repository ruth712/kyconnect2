<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //student data
    $fullName = $_POST["full_name"];
    $pwd = $_POST["pwd"];
    $studentEmail = $_POST["student_email"];
    $contactNumber = $_POST["contact_number"];
    $studentId = $_POST["student_id"];
    $house = $_POST["house"];

    //guardian 1 data
    $guardian1FullName = $_POST["guardian1_full_name"];
    $guardian1Relationship = $_POST["guardian1_relationship"];
    $guardian1Email = $_POST["guardian1_email"];
    $guardian1ContactNumber = $_POST["guardian1_contact_number"];

    //guardian 2 data
    $guardian2FullName = $_POST["guardian2_full_name"];
    $guardian2Relationship = $_POST["guardian2_relationship"];
    $guardian2Email = $_POST["guardian2_email"];
    $guardian2ContactNumber = $_POST["guardian2_contact_number"];

    //students blocks data ++ haven't post block yet into database
    $block1 = $_POST["block1"];
    $block2 = $_POST["block2"];
    $block3 = $_POST["block3"];
    $block4 = $_POST["block4"];
    $block5 = $_POST["block5"];
    $block6 = $_POST["block6"];


    try {
        //link to a file
        require_once "dbh-inc.php"; //include gives warning, require gives error
        require_once "signup_student_model.inc.php";
        require_once "signup_student_contr.inc.php";

        // Error Handlers
        $errors = [];

        if (is_input_empty($fullName, $pwd, $studentEmail)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($studentEmail)) {
            $errors["invalid_email"] = "Invalid email used";
        }
        if (is_email_registered($pdo, $studentEmail)) {
            $errors["email_used"] = "Email already registered";
        }
        if (is_fullname_taken($pdo, $fullName)) {      
            $errors["username_taken"] = "Username already taken";
        }
        

        require_once "cofig_session.inc.php";

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [ //allow data to appear on screen if user submitted data with errors
                "full_name" => $fullName,
                "student_email" => $studentEmail,
            ];
            $_SESSION["errors_signup"] = $signupData;

            header("Location: ../.php");
        }

        create_user($pdo, $fullName, $pwd, $studentEmail, $contactNumber, $studentId, $house, $guardian1FullName, $guardian1Relationship, $guardian1ContactNumber, $guardian1Email, $guardian2FullName, $guardian2Relationship, $guardian2ContactNumber, $guardian2Email);

        header("Location: ../.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../.php");//need to redirect somewhere
}