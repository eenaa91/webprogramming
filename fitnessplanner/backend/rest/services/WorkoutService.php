<?php
require_once __DIR__ . '/../dao/WorkoutPlanDao.php';

class WorkoutService {

    private $dao;

    public function __construct() {
        $this->dao = new WorkoutPlanDao();
    }

    public function get_all() {
        return $this->dao->getAll();
    }

    public function get_by_id($id) {

        $workout = $this->dao->getById($id);

        if (!$workout) {
            Flight::halt(404, "Workout plan not found.");
        }

        return $workout;
    }

    public function add($data) {

        // Validate required fields
        if (empty($data['title']) || empty($data['difficulty'])) {
            Flight::halt(400, "Title and difficulty are required.");
        }

        // Optional fields defaulting
        if (!isset($data['duration_weeks'])) {
            $data['duration_weeks'] = null;
        }

        return $this->dao->insert($data);
    }

    public function update($id, $data) {

        // Check if exists
        $existing = $this->dao->getById($id);
        if (!$existing) {
            Flight::halt(404, "Workout plan not found.");
        }

        // Validate fields
        if (isset($data['title']) && $data['title'] === "") {
            Flight::halt(400, "Title cannot be empty.");
        }

        if (isset($data['difficulty']) && $data['difficulty'] === "") {
            Flight::halt(400, "Difficulty cannot be empty.");
        }

        return $this->dao->update($id, $data);
    }

    public function delete($id) {

        $existing = $this->dao->getById($id);
        if (!$existing) {
            Flight::halt(404, "Workout plan not found.");
        }

        return $this->dao->delete($id);
    }
}
?>
