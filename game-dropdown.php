<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select a Game</title>
</head>
<body>

<form method="post">
    <fieldset>
        <label for="gameId">Choose a Game</label>
        <select name="gameId" id="gameId">
            <?php
            // connect
            $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

            // set up, run query, & store results
            $sql = "SELECT * FROM games ORDER BY title";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $games = $cmd->fetchAll();

            // loop through results, adding an option for every game to the dropdown
            foreach ($games as $v) {
                echo '<option value="' . $v['gameId'] . '">' . $v['title'] . '</option>';
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
</form>

</body>
</html>
