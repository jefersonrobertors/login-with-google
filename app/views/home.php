<?php
global $auth;
global $session;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>
    <?php
       if($auth->isLogged()):
    ?>
    <div class="center">
        <?php
            $sessionAuth = $session->getSession('auth');
            echo "Welcome back, " . $sessionAuth->firstName . ' ' . $sessionAuth->lastName;
        ?>
        <a href="/deauth">Logout</a>
    </div>
    <?php
       else:
    ?>
    <div class="center">
        <a href="/login">Fazer Login</a>
    </div>
    <?php
       endif;
    ?>
</body>
</html>