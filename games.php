<?php
$title = 'Our Games';
include 'header.php'; ?>

<h1>Our Games</h1>
<a href="game-details.php">Add a New Game</a>

<?php
try {
    // 1. Connect to your AWS db, using the credentials you received via email:  Host – 172.31.22.43 / Database – your-db-name / Username – your-username / Password – your-password
    include 'db.php';

    // 2. Write the SQL Query to read all the records from the games table
    $sql = "SELECT games.*, publishers.name FROM games 
        INNER JOIN publishers ON games.publisherId = publishers.publisherId";

    // 3. Create a Command variable $cmd then use it to run the SQL Query
    $cmd = $db->prepare($sql);
    $cmd->execute();

    // 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $games.  See https://www.php.net/manual/en/pdostatement.fetchall.php for details.
    $games = $cmd->fetchAll();

    // 4a. Create an HTML table to format the games data in a grid
    // use bootstrap table classes to style the table
    echo '<table class="table table-striped table-hover">
        <thead>
            <th>Title</th>
            <th>Release Year</th>
            <th>Rating</th>
            <th>Publisher</th>        
            <th>Actions</th>
        </thead>';

    // 5. Use a foreach loop to iterate (cycle) through all the values in the $games variable.  Inside this loop, use an echo command to display the title of each game.  See https://www.php.net/manual/en/control-structures.foreach.php for details.
    // <tr> creates a new table row; <td> creates a new table cell or column ("table data")
    foreach ($games as $v) {
        echo '<tr><td><a href="game-details.php?gameId=' . $v['gameId'] . '">
            ' . $v['title'] . '</a></td>
            <td>' . $v['releaseYear'] . '</td>
            <td>' . $v['rating'] . '</td>
            <td>' . $v['name'] . '</td>
            <td><a href="delete-game.php?gameId=' . $v['gameId'] . '" 
                class="btn btn-danger" onclick="return yaSure();">Delete</a></td></tr>';
    }

    // 5a. Close the table
    echo '</table>';

    // 6. Disconnect from the database
    $db = null;
}
catch (exception $e) {
    // optional send error via email
    //mail('me@email.com', 'PHP Gaming Error', $e, 'From:support@domain.com');

    // redirect to error page instead of showing the error details
    header('location:error.php');
}
?>
</body>
</html>

