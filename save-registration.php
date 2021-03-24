<?php
$title = "Registering...";
include 'header.php';

// capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo 'Username required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    // connect
    include 'db.php';

    // set up SQL
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

    // hash password & fill parameters
    $password = password_hash($password, PASSWORD_DEFAULT);
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);

    // execute
    $cmd->execute();

    // disconnect
    $db = null;

    // redirect to login
    header('location:login.php');
}

?>

</body>
</html>
