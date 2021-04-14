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

// recaptcha validation
$apiUrl = 'https://www.google.com/recaptcha/api/siteverify'; // from the api docs
$secret = '6LdEx6kaAAAAANNjVOVJZvwcmHD_tFIMyzrlIqlh'; // paste from recaptcha console
$response = $_POST['recaptchaResponse'];

// make the api call and parse the json object we get back from google
$apiResponse = file_get_contents($apiUrl . "?secret=$secret&response=$response");
$decodedReponse = json_decode($apiResponse); // convert json response to an array

if ($decodedReponse->success == false) {
    echo 'Are you human?';
    $ok = false;
}
else {
    // if recaptcha score is lower than .5 probably a bot (0.0 = bot, 1.0 = human)
    if ($decodedReponse->score < 0.5) {
        echo 'Are you human?';
        $ok = false;
    }
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
