<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Game Details...</title>
</head>
<body>
<?php
include 'auth.php';

// store the values entered in the form in variables
$title = $_POST['title'];
$releaseYear = $_POST['releaseYear'];
$rating = $_POST['rating'];
$publisherId = $_POST['publisherId'];
$gameId = $_POST['gameId'];
// add variable to indicate if we should save or not
$ok = true;

// validate inputs before saving to ensure all data is valid
if (empty(trim($title))) { // use trim to remove leading & trailing spaces
    echo 'Title is required<br />';
    $ok = false;
}

if (empty($releaseYear)) {
    echo 'Release Year is required<br />';
    $ok = false;
}
else {
    if (!is_numeric($releaseYear)) {
        echo 'Release Year must be numeric<br />';
        $ok = false;
    }
}

if (empty($publisherId)) {
    echo 'Publisher is required<br />';
    $ok = false;
}
else {
    if (!is_numeric($publisherId)) {
        echo 'Publisher Id must be numeric<br />';
        $ok = false;
    }
}

// photo upload
$photo = null;

if ($_FILES['photo']['name'] != null) {
    // get the file name
    $photo = $_FILES['photo']['name'];

    // get temp location
    $tmp_name = $_FILES['photo']['tmp_name'];

    // verify file is an image
    $type = mime_content_type($tmp_name);
    if ($type != "image/png" && $type != "image/jpeg") {
        echo 'Please upload a .jpg or .png file<br />';
        $ok = false;
    }
    else {
        // file is valid so move to img/game-uploads using the session Id
        $photo = session_id() . "-" . $photo;
        move_uploaded_file($tmp_name, "img/game-uploads/$photo");
    }
}
else {
    $photo = $_POST['currentPhoto'];
}

if ($ok == true) {
    try {
        // connect to the db
        include 'db.php';

        // if gameId, update existing record
        if (!empty($gameId)) {
            $sql = "UPDATE games SET title = :title, releaseYear = :releaseYear,
                rating = :rating, publisherId = :publisherId,
                 photo = :photo WHERE gameId = :gameId";
        } else {
            // if no gameId, add new record
            // set up the SQL INSERT command to add a new game.  : indicates a placeholder or paramter
            $sql = "INSERT INTO games (title, releaseYear, rating, publisherId, photo) VALUES 
                    (:title, :releaseYear, :rating, :publisherId, :photo)";
        }

        // fill the INSERT parameters with our variables
        // connect the db connection w/the SQL command
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 10);
        $cmd->bindParam(':publisherId', $publisherId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $photo, PDO::PARAM_STR,100);
        if (!empty($gameId)) {
            $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        }

        // execute the save
        $cmd->execute();

        // disconnect
        $db = null;

        echo "Game Saved";
        header('location:games.php');
    }
    catch (exception $e) {

        // redirect to error page instead of showing the error details
        header('location:error.php');
        exit(); // stop code execution now
    }
}
?>
</body>
</html>
