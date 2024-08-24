<?php
//dd($_POST);

use Core\Validator;
use Core\Database;
use Core\App;

$config = require(base_path("config.php"));

$currentUserId = 1; //hard-coded
$errors = [];


$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

//validate the email
if (!Validator::string($email, 1, 255)) {

    $errors['email'] = 'Email must be between 1 and 255 characters';
}

if (!Validator::email($email)) {

    $errors['email'] = 'please specify a valid email.';
}

//validate the password
if (!Validator::string($password, 7, 15)) {

    $errors['password'] = 'Password must be between 7 and 15 characters';
}

if (!empty($errors)) {
    return view("auth/create.view.php", [
        'heading' => "Signup",
        'errors' => $errors
    ]);
}


$db = App::resolve(Database::class);
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    return view("auth/create.view.php", [
        'heading' => "Sign Up",
        'errors' => [
            'email' => 'email is already registered.'
        ]
    ]);
} else {
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => $config['password_hash']($password) // NEVER store database passwords in clear text. We'll fix this in the login form episode. :)
    ]);

    $_SESSION['user'] = [
        'email' => $email
    ];
}
login($user);
redirect('/');
