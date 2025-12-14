<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/config.php';

require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/data/roles.php';

require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/MealService.php';
require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/ProgressService.php';
require_once __DIR__ . '/rest/services/WorkoutService.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

Flight::register('auth_service', 'AuthService');
Flight::register('mealService', 'MealService');
Flight::register('userService', 'UserService');
Flight::register('progressService', 'ProgressService');
Flight::register('workoutService', 'WorkoutService');
Flight::register('auth_middleware', 'AuthMiddleware');


Flight::before('start', function () {

    $url = Flight::request()->url;

    if (
        str_starts_with($url, '/auth/login') ||
        str_starts_with($url, '/auth/register') ||
        $url === '/' ||
        $url === ''
    ) {
        return TRUE;
    }

    $authHeader = Flight::request()->getHeader("Authorization");

    if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        Flight::halt(401, "Missing or invalid Authorization header");
    }

    Flight::auth_middleware()->verifyToken($matches[1]);
});

require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/mealPlanRoutes.php';
require_once __DIR__ . '/rest/routes/userRoutes.php';
require_once __DIR__ . '/rest/routes/progressRoutes.php';
require_once __DIR__ . '/rest/routes/workoutRoutes.php';

Flight::start();
