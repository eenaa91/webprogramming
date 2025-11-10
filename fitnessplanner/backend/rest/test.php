<?php
require_once 'dao/UserDao.php';
require_once 'dao/MealPlanDao.php';
require_once 'dao/WorkoutPlanDao.php';
require_once 'dao/ProgressDao.php';

// ==== MEAL PLAN TEST ====
$mealPlanDao = new MealPlanDao();
$meal_id = $mealPlanDao->insert([
    'title' => 'Healthy Breakfast',
    'type' => 'Breakfast',
    'calories' => 350,
    'description' => 'Oatmeal with fruits and yogurt'
]);
echo "✅ Meal plan inserted successfully.<br>";

// ==== USER TEST ====
$userDao = new UserDao();
try {
    $user_id = $userDao->insert([
        'full_name' => 'John Doe',
        // dodan složeniji uniqid da uvijek bude jedinstven
        'email' => 'john' . uniqid(rand(), true) . '@example.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        'role' => 'user',
        'meal_id' => $meal_id
    ]);
    echo "✅ User inserted successfully.<br>";
} catch (PDOException $e) {
    echo "⚠️ User insert failed: " . $e->getMessage() . "<br>";
}

// ==== WORKOUT PLAN TEST ====
$workoutDao = new WorkoutPlanDao();
try {
    $workoutDao->insert([
        'title' => 'Full Body Workout',
        'description' => 'Strength training for all major muscle groups',
        'difficulty' => 'Medium',
        'duration_weeks' => 6
    ]);
    echo "✅ Workout plan inserted successfully.<br>";
} catch (PDOException $e) {
    echo "⚠️ Workout insert failed: " . $e->getMessage() . "<br>";
}

// ==== PROGRESS TEST ====
$progressDao = new ProgressDao();
try {
    $progressDao->insert([
        'user_id' => $user_id,
        'log_date' => date('Y-m-d'),
        'weight' => 72.5,
        'notes' => 'Good progress this week!'
    ]);
    echo "✅ Progress inserted successfully.<br>";
} catch (PDOException $e) {
    echo "⚠️ Progress insert failed: " . $e->getMessage() . "<br>";
}
?>
