function validateUserData() {
    console.log('Validating...');
    try {
        var pw = document.getElementById('edt_password').value;
        var em = document.getElementById('edt_username').value;

        console.log('Validating username=' + em + ', password=' + pw);

        if (pw == null || pw == '' || em == null || em == '') {
            alert('Both fields must be filled out');
            return false;
        }

        if (em.indexOf('@') == -1) {
            alert('Invalid email address');
            return false;
        }

        return true;
    } catch (exception) {
        return false;
    }
}
