<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$config = require(base_path("config.php"));
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {

    $db = App::resolve(Database::class);
    $user = $db->query('select * from users where email = :email', ['email' => $email])->find();
    if ($user && $config['password_verify']($password, $user['password'])) {
        login($user);
        header('location: /');
        exit();
    }


    $form->error('email', 'No matching account found for that email address and password.');
}

return view('session/create.view.php', [
    'errors' => $form->errors()
]);
