<?php

//PRG Pattern:
// POST when we store/login/add
// Redirect on success
// GET incase of errors/failure --> use sessions for this

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching account found for that email address and password.');
    Session::flash('old', ['email' => $_POST['email']]);
}

Session::flash('errors', $form->errors());
return redirect('/login');
