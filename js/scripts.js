// delete confirmation - can be used for any delete
function yaSure() {
    // use the js confirm() function: OK = true, Cancel = false
    return confirm('Are you sure you want to delete this?');
}

// password compare for registration
function comparePasswords() {
    var pw1 = document.getElementById('password').value;
    var pw2 = document.getElementById('confirm').value;
    // reference span tag on register page used for showing errors (which we'll add)
    var pwMsg = document.getElementById('pwMsg');

    if (pw1 != pw2) {
        pwMsg.innerText = 'Passwords do not match';
        pwMsg.className = 'text-danger';
        return false; // cancel any form submission if Register button clicked
    }
    else {
        pwMsg.innerText = '';
        pwMsg.className = '';
        return true;
    }
}