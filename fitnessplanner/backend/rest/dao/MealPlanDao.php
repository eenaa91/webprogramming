<?php
require_once __DIR__ . '/BaseDao.php';

class MealPlanDao extends BaseDao {

    public function __construct() {
        parent::__construct('meal_plans', 'meal_id');
    }

}
?>

