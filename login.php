<?php
$title = 'Login';
include 'header.php';
?>

<main class="container">
    <h1>Login</h1>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <div class="offset-3">
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
</main>

</body>
</html>
