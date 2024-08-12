<?php

declare(strict_types=1);

//put function inside html page to execute the function
function signup_inputs() {
    if (isset($_SESSION["signup_data"]["full_name"]) && !isset($_SESSION["errors_signup"]["fullname_taken"])) {
        echo '<input type="text" name="fullname" placeholder="Fullname" value=""' . $_SESSION["signup_data"]["full_name"] . '">"';
    } else {
        echo '<input type="text" name="fullname" placeholder="Fullname">';
    }

    echo '<input type="text" name="pwd" placeholder="Password">';

    if (isset($_SESSION["signup_data"]["student_email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="E-mail" value="' . $_SESSION["signup_data"]["student_email"] . '">"';
    } else {
        echo '<input type="text" name="email" placeholder="E-mail">';
    }
}

//show users that there are errors
function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class = "form-error"> . $error . <p>';
        }

        unset($_SESSION['errors_signup']);
    }
}