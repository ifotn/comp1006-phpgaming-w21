<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Publisher...</title>
</head>
<body>
<?php
// store the values entered in the form in variables
$name = $_POST['name'];

// add variable to indicate if we should save or not
$ok = true;

// validate inputs before saving to ensure all data is valid
if (empty(trim($name))) { // use trim to remove leading & trailing spaces
    echo 'Name is required<br />';
    $ok = false;
}

if ($ok == true) {
//connect to the db
include 'db.php';

//set up the sql insert command to add a new game :indicates a placeholder or parameter
    $sql = "INSERT INTO publishers (name) VALUES (:name)";
//fill the INSERT parameters with our variables
//connect thedb connection iwth the sql command
    $cmd = $db->prepare($sql);
    $cmd ->bindParam(':name',$name,PDO::PARAM_STR,100);
//execute the save
    $cmd->execute();
//disconnect
    $db = null;
// display the game title entered by the user
    echo 'Publisher Saved';
}

?>
</body>
</html>
