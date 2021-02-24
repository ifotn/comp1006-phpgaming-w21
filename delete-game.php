<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Game...</title>
</head>
<body>
<?php
// get the selected gameId from the url parameter using the $_GET array
$gameId = $_GET['gameId'];

if (is_numeric($gameId)) {
    // connect
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // set up & run the SQL DELETE command
    $sql = "DELETE FROM games WHERE gameId = :gameId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $db = null;
}

// redirect to updated games.php
header('location:games.php');
?>
</body>
</html>
