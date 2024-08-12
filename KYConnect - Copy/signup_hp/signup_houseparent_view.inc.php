<?php

declare(strict_types=1);

// Function to display signup inputs with previous values if errors exist
function signup_inputs() {
    if (isset($_SESSION["signup_data"]["hp_full_name"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo '<input type="text" name="fullname" placeholder="Fullname" value="' . $_SESSION["signup_data"]["hp_full_name"] . '">';
    } else {
        echo '<input type="text" name="fullname" placeholder="Fullname">';
    }

    echo '<input type="password" name="pwd" placeholder="Password">';

    if (isset($_SESSION["signup_data"]["hp_email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="E-mail" value="' . $_SESSION["signup_data"]["hp_email"] . '">';
    } else {
        echo '<input type="text" name="email" placeholder="E-mail">';
    }
}

// Function to display signup errors
function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>'; 
        }

        unset($_SESSION['errors_signup']);
    }
}
