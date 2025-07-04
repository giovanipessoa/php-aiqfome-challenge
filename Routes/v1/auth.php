<?php

use WebUI\Controllers\AuthController;

switch ($route) {
    case 'POST /v1/auth/login':
        $controller = $container->get(AuthController::class);
        $controller->login();
        break;
}
