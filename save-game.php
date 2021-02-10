<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Game Details...</title>
</head>
<body>
<?php
// store the values entered in the form in variables
$title = $_POST['title'];
$releaseYear = $_POST['releaseYear'];
$rating = $_POST['rating'];
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

if ($ok == true) {
    // connect to the db
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

    // set up the SQL INSERT command to add a new game.  : indicates a placeholder or paramter
    $sql = "INSERT INTO games (title, releaseYear, rating) VALUES (:title, :releaseYear, :rating)";

    // fill the INSERT parameters with our variables
    // connect the db connection w/the SQL command
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
    $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
    $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 10);

    // execute the save
    $cmd->execute();

    // disconnect
    $db = null;

    echo "Game Saved";
}
?>
</body>
</html>
