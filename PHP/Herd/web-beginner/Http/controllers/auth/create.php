<?php

use Core\Session;

view("auth/create.view.php", [
    'heading' => "Sign Up",
    'errors' => Session::get('errors')
]);
