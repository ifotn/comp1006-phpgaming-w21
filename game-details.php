<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Details</title>
</head>
<body>

<form method="post" action="save-game.php">
    <fieldset>
        <label for="title">Title: </label>
        <input name="title" id="title" required />
    </fieldset>
    <fieldset>
        <label for="releaseYear">Release Year:</label>
        <input name="releaseYear" id="releaseYear" required type="number" />
    </fieldset>
    <fieldset>
        <label for="rating">Rating:</label>
        <input name="rating" id="rating" />
    </fieldset>
    <button>Save</button>
</form>

</body>
</html>
