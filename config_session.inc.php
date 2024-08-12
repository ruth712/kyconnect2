<?php 

ini_set('session.use_only_cookies', 1); // we can go inside the ini file and change some of the parameters using code 
ini_set('session.use_strict_mode', 1); // we make sure that the wbsite only uses session id  that has actually been created by our server inside the website, +make our session id a bit more complex 

//creating cookie parameter 
session_set_cookie_parameter(['lifetime' => 1800, 'domain' => 'localhost', 'path' => '/', 'secure' => true, 'httponly' => true]); 

session_start(); 

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION['last_regeneration'])) { 
        regenerate_session_id_loggedin();
    } else { 
        $interval = 60 * 30; 
        if (time() - $_SESSION['last_regenaration'] >= $interval) { 
            regenerate_session_id_loggedin();
        } 
    }
} else {
    //regenerate id every 30 mins 
    if (!isset($_SESSION['last_regeneration'])) { 
        regenerate_session_id();
    } else { 
        $interval = 60 * 30; 
        if (time() - $_SESSION['last_regenaration'] >= $interval) { 
            regenerate_session_id();
        } 
    } 
}

function regenerate_session_id_loggedin() {
    session_regenerate_id(true); 

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);

    $_SESSION['last_regeneration'] = time();
}


//regenerate id every 30 mins 

function regenerate_session_id() {
    session_regenerate_id(true); 
    $_SESSION['last_regeneration'] = time();
}