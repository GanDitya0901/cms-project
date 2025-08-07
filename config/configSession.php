<?php
ini_set("session.use_only_cookies", "1");
ini_set("session.use_strict_mode", "1");

session_set_cookie_params([
    "lifetime" => 1800,
    "domain" => "localhost",
    "path" => "/",
    "secure" => true,
    "httponly" => true,
]);

session_start();

if(isset($_SESSION["user_id"])) {
    if(!isset($_SESSION["last_regeneration"])) {
        regenerateSessionLoggedIn();
    } else {
        $interval = 60 * 30;
        if(time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerateSessionLoggedIn();
        }  
    }
} else {
    if(!isset($_SESSION["last_regeneration"])) {
        regenerateSession();
    } else {
        $interval = 60 * 30;
        if(time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerateSession();
        }  
    }
}

function regenerateSession() {
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

function regenerateSessionLoggedIn() {
    session_regenerate_id(true);

    $user_id = $_SESSION["user_id"];

    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $user_id;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();
}
?>