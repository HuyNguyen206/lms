import $ from 'jquery'

$('#togglePassword').on('click', function () {
    const passwordField = $('#password');
    const fieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', fieldType);
})

