<?php
require_once __DIR__ . '/../dao/MealPlanDao.php';

class MealService {

    private $dao;

    public function __construct() {
        $this->dao = new MealPlanDao();
    }

    public function get_all() {
        return $this->dao->getAll();
    }

    public function get_by_id($id) {
        $meal = $this->dao->getById($id);

        if (!$meal) {
            Flight::halt(404, "Meal plan not found.");
        }

        return $meal;
    }

    public function add($data) {

        // Required fields
        if (empty($data['title']) || empty($data['type'])) {
            Flight::halt(400, "Title and type are required.");
        }

        if (!isset($data['calories'])) {
            $data['calories'] = null;
        }

        if (!isset($data['description'])) {
            $data['description'] = null;
        }

        return $this->dao->insert($data);
    }

    public function update($id, $data) {

        $existing = $this->dao->getById($id);

        if (!$existing) {
            Flight::halt(404, "Meal plan not found.");
        }

        if (isset($data['title']) && trim($data['title']) === "") {
            Flight::halt(400, "Title cannot be empty.");
        }

        if (isset($data['type']) && trim($data['type']) === "") {
            Flight::halt(400, "Type cannot be empty.");
        }

        return $this->dao->update($id, $data);
    }

    public function delete($id) {

        $existing = $this->dao->getById($id);

        if (!$existing) {
            Flight::halt(404, "Meal plan not found.");
        }

        return $this->dao->delete($id);
    }
}
?>

