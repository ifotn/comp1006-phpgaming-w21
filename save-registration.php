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

    // check if user already exists
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    if (!empty($user)) {
        echo '<h5 class="alert alert-danger">User already exists</h5>';
        $db = null;
        exit(); // stop processing more code
    }

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
