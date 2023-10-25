<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use app\services\CsfrProtection;
use app\services\CsfrService;
use app\utils\Flash;

final class LoginController extends Controller {

    public function main() : void {
        $this->view('login');
    }

    public function validate() : void {
        if(isset($_POST['email'], $_POST['password'])) {
            $email = strip_tags(trim($_POST['email']));
            $password = strip_tags(trim($_POST['password']));

            if(empty($email)) {
                Flash::create('login', 'Field email must have a value!', 'error');
                header('Location: /login');
                exit;
            }
            if(empty($password)) {
                Flash::create('login', 'Field password must have a value!', 'error');
                header('Location: /login');
                exit;
            }
            if(CsfrProtection::isValidToken()) {
                echo 'Token is valid';
            }
        }
    }

    public function deauth() {
        global $session;
        $session->removeSession('auth');
        header('Location: /');
    }
}
?>