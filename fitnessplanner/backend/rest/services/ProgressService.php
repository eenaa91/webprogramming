<?php
require_once __DIR__ . '/../dao/ProgressDao.php';

class ProgressService {
    private $dao;

    public function __construct() {
        $this->dao = new ProgressDao();
    }

    public function get_all() {
        return $this->dao->getAll();
    }

    public function get_by_id($id) {
        return $this->dao->getById($id);
    }

    public function add($data) {
        if (empty($data['user_id']) || empty($data['log_date']) || empty($data['weight'])) {
            throw new Exception("Missing required fields: user_id, log_date or weight");
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
