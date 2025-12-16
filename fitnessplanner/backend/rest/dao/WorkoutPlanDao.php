<?php
require_once __DIR__ . '/BaseDao.php';

class WorkoutPlanDao extends BaseDao {

    public function __construct() {
        parent::__construct("workout_plans", "plan_id");
    }

}
?>
