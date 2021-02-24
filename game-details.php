<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Details</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <!-- Navbar content -->
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP Gaming</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <span class="navbar-text">
        Navbar text with an inline element
      </span>
        </div>
</nav>
<?php
// check if adding or editing.  if editing, get values to populate the form
if (!empty($_GET['gameId'])) {
    $gameId = $_GET['gameId'];

    // look up the selected game in the db
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');
    $sql = "SELECT * FROM games WHERE gameId = :gameId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);
    $cmd->execute();
    // use fetch not fetchAll as we're only selecting a single record & don't need a loop
    $game = $cmd->fetch();
    $db = null;
}
else {
    // if no id, we are adding, so initialize the $game variable to null
    $game = null;
}
?>
<main class="container">
    <h1>Game Details</h1>
    <form method="post" action="save-game.php">
        <fieldset class="p-2">
            <label for="title" class="col-2">Title: </label>
            <input name="title" id="title" required maxlength="50"
                value="<?php echo $game['title']; ?>" />
        </fieldset>
        <fieldset class="p-2">
            <label for="releaseYear" class="col-2">Release Year:</label>
            <input name="releaseYear" id="releaseYear" required type="number" min="1960"
                value="<?php echo $game['releaseYear']; ?>" />
        </fieldset>
        <fieldset class="p-2">
            <label for="rating" class="col-2">Rating:</label>
            <input name="rating" id="rating" maxlength="10"
                value="<?php echo $game['rating']; ?>" />
        </fieldset>
        <fieldset class="p-2">
            <label for="publisherId" class="col-2">Publisher:</label>
            <select name="publisherId" id="publisherId">
                <?php
                // connect
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

                // set up & run query to get all publishers
                $sql = "SELECT * FROM publishers ORDER BY name";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $publishers = $cmd->fetchAll();

                // add each publisher to the list
                foreach ($publishers as $p) {
                    if ($game['publisherId'] == $p['publisherId']) {
                        echo '<option selected value="' . $p['publisherId'] . '">' . $p['name'] . '</option>';
                    }
                    else {
                        echo '<option value="' . $p['publisherId'] . '">' . $p['name'] . '</option>';
                    }
                }

                // disconnect
                $db = null;
                ?>
            </select>
        </fieldset>
        <input name="gameId" id="gameId" type="hidden" value="<?php echo $game['gameId']; ?>" />
        <button class="offset-3 btn btn-primary p-2">Save</button>
    </form>
</main>

</body>
</html>
