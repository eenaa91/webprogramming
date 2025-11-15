<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';


require_once __DIR__ . '/rest/services/MealService.php';
require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/ProgressService.php';
require_once __DIR__ . '/rest/services/WorkoutService.php';

Flight::register('mealService', 'MealService');
Flight::register('userService', 'UserService');
Flight::register('progressService', 'ProgressService');
Flight::register('workoutService', 'WorkoutService');


require_once __DIR__ . '/rest/routes/mealPlanRoutes.php';
require_once __DIR__ . '/rest/routes/userRoutes.php';
require_once __DIR__ . '/rest/routes/progressRoutes.php';
require_once __DIR__ . '/rest/routes/workoutRoutes.php';

echo "<h1>Fitness Planner Backend Running</h1>";
echo "<p><a href='public/v1/docs/index.php'>Open Swagger Docs</a></p>";


Flight::set('flight.log_errors', true);
Flight::start();
