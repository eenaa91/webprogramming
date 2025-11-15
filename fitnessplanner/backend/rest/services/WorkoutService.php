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
        return $this->dao->getById($id);
    }

    public function add($data) {
        if (empty($data['title']) || empty($data['difficulty'])) {
            throw new Exception("Missing required fields: title or difficulty");
        }
        return $this->dao->insert($data);
    }

    public function update($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
