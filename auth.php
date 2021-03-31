<?php
// call session_start if it hasn't been called already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// check for a session variable called "username" to see if user is logged in
if (empty($_SESSION['username'])) {
    // redirect to login
    header('location:login.php');
    // stop all other page execution
    exit();
}

?>