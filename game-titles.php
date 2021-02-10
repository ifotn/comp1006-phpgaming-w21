<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Titles</title>
</head>
<body>
<?php
// 1. Connect to your AWS db, using the credentials you received via email:  Host – 172.31.22.43 / Database – your-db-name / Username – your-username / Password – your-password
$db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

// 2. Write the SQL Query to read all the records from the games table
$sql = "select * from games";

// 3. Create a Command variable $cmd then use it to run the SQL Query
$cmd = $db->prepare($sql);
$cmd->execute();

// 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $games.  See https://www.php.net/manual/en/pdostatement.fetchall.php for details.
$games = $cmd->fetchAll();

echo '<ul>';

// 5. Use a foreach loop to iterate (cycle) through all the values in the $games variable.  Inside this loop, use an echo command to display the title of each game.  See https://www.php.net/manual/en/control-structures.foreach.php for details.
foreach ($games as $v){
    echo '<li>' . $v['title'] . '</li>';
}

echo '</ul>';

// 6. Disconnect from the database
$db = null;
?>
</body>
</html>
