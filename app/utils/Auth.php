<?php

declare(strict_types=1);

namespace app\utils;

use app\models\User;

final class Auth {

    private Session $session;

    public function __construct()
    {
        $this->session = new Session;
    }

    public function authGoogle($data)
    {
        $user = new User;
        $found = $user->find('email', $data->email);

        if(!$found) {
            Flash::create('login', 'This email is not registered.', 'error');
            header('Location: /login');
            exit;
        }
        $this->session->setSession('auth', $found);
        header('Location: /');
    }

    public function isLogged()
    {
        return $this->session->hasSession('auth');
    }
}
?>