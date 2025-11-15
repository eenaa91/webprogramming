<?php
require_once __DIR__ . '/BaseDao.php';



class WorkoutPlanDao extends BaseDao {

    public function __construct() {
        parent::__construct('workout_plans', 'plan_id');
    }

    // ===== CRUD metode =====
    public function createWorkoutPlan($data) {
        return parent::insert($data);
    }

    public function getAllWorkoutPlans() {
        return parent::getAll();
    }

    public function getWorkoutPlanById($id) {
        return parent::getById($id);
    }

    public function updateWorkoutPlan($id, $data) {
        return parent::update($id, $data);
    }

    public function deleteWorkoutPlan($id) {
        return parent::delete($id);
    }
}
?>
