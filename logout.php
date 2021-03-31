<?php
// access the session
session_start();

// remove all session variables
session_unset();

// end the session
session_destroy();

// return to login
header('location:login.php');
?>