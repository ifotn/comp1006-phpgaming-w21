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

<main class="container">
    <h1>Game Details</h1>
    <form method="post" action="save-game.php">
        <fieldset class="p-2">
            <label for="title" class="col-2">Title: </label>
            <input name="title" id="title" required maxlength="50" />
        </fieldset>
        <fieldset class="p-2">
            <label for="releaseYear" class="col-2">Release Year:</label>
            <input name="releaseYear" id="releaseYear" required type="number" min="1960" />
        </fieldset>
        <fieldset class="p-2">
            <label for="rating" class="col-2">Rating:</label>
            <input name="rating" id="rating" maxlength="10" />
        </fieldset>
        <fieldset class="p-2">
            <label for="publisherId" class="col-2">Publisher:</label>
            <select name="publisherId" id="publisherId">
                <?php
                // connect
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

                // set up & run query to get all publishers
                $sql = "SELECT * FROM publishers ORDER BY name";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $publishers = $cmd->fetchAll();

                // add each publisher to the list
                foreach ($publishers as $p) {
                    echo '<option value="' . $p['publisherId'] . '">' . $p['name'] . '</option>';
                }

                // disconnect
                $db = null;
                ?>
            </select>
        </fieldset>
        <button class="offset-3 btn btn-primary p-2">Save</button>
    </form>
</main>

</body>
</html>
