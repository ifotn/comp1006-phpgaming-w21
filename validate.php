<?php
// get form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// connect
include 'db.php';
$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);

// check if username exists
$cmd->execute();
$user = $cmd->fetch();

if (!empty($user)) {
    // check if password is valid
    if (password_verify($password, $user['password'])) {
        // password is valid
        session_start(); // accesses the current session
        $_SESSION['username'] = $username; // store identity in a session variable
        header('location:games.php');
    }
    else { // invalid password
        header('location:login.php?invalid=true');
    }
}
else {
    header('location:login.php?invalid=true');
}

?>