<?php
require_once __DIR__ . '/BaseDao.php';

class ProgressDao extends BaseDao {

    public function __construct() {
        parent::__construct('progress', 'progress_id');
    }

    // ===== CRUD metode =====
    public function createProgress($data) {
        return parent::insert($data);
    }

    public function getAllProgress() {
        return parent::getAll();
    }

    public function getProgressById($id) {
        return parent::getById($id);
    }

    public function updateProgress($id, $data) {
        return parent::update($id, $data);
    }

    public function deleteProgress($id) {
        return parent::delete($id);
    }
}
?>
