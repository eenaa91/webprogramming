<?php
require_once __DIR__ . '/BaseDao.php';

class MealPlanDao extends BaseDao {

    public function __construct() {
        parent::__construct('meal_plans', 'meal_id');
    }

    // ===== CRUD metode =====
    public function createMealPlan($data) {
        return parent::insert($data);
    }

    public function getAllMealPlans() {
        return parent::getAll();
    }

    public function getMealPlanById($id) {
        return parent::getById($id);
    }

    public function updateMealPlan($id, $data) {
        return parent::update($id, $data);
    }

    public function deleteMealPlan($id) {
        return parent::delete($id);
    }
}
?>
