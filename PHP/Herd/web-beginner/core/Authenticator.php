<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
                'email' => $email
            ])->find();

        $config = require(base_path("config.php"));


        if ($user && $config['password_verify']($password, $user['password'])) {
            $this->login([
                'email' => $email
            ]);

            return true;
        }
        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public static function logout()
    {
        Session::destroy();
    }
}
