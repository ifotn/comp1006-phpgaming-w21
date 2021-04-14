<?php
$title = 'Register';
include 'header.php';
?>

<main class="container">
    <h1>User Registration</h1>
    <h5 class="alert alert-info">Password Rules: min 8 characters, 1 digit, 1 upper, 1 lowercase letter</h5>
    <form method="post" action="save-registration.php">
        <fieldset class="form-group">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                onkeyup="return comparePasswords();" />
            <span id="pwMsg"></span>
        </fieldset>
        <div class="offset-3">
            <button class="btn btn-primary" onclick="return comparePasswords();">Register</button>
        </div>
        <input type="hidden" name="recaptchaResponse" id="recaptchaResponse" />
    </form>
</main>

<!-- recaptcha js api -->
<script src="https://www.google.com/recaptcha/api.js?render=6LdEx6kaAAAAABfsOaUmhE-sAud-iYRDifaLnbRo"></script>
<script type="text/javascript">
    grecaptcha.ready(function() {
        grecaptcha.execute('6LdEx6kaAAAAABfsOaUmhE-sAud-iYRDifaLnbRo', { action: 'register' })
        .then(function(token) {
            // get token response from google api and put value in our hidden field
            var recaptchaRespose = document.getElementById('recaptchaResponse');
            recaptchaRespose.value = token;
            // just for testing
            //alert(token)
        })
    })
</script>
</body>
</html>


