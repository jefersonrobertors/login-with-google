<?php

use app\library\GoogleClient;
use app\routes\Router;
use app\utils\Auth;
use app\utils\Session;

global $session;
$session = new Session;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

global $googleClient;
$googleClient = new GoogleClient;
$googleClient->init();

global $auth;
$auth = new Auth;

if($googleClient->authorized()) {
    $auth->authGoogle($googleClient->getData());
}
$router = new Router;
$router->get('/', 'HomeController:main');
$router->get('/login', 'LoginController:main');
$router->post('/login', 'LoginController:validate');
$router->get('/deauth', 'LoginController:deauth');
$router->dispatch();
?>