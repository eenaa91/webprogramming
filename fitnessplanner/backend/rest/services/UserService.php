<?php
require_once __DIR__ . '/../dao/UserDao.php';

class UserService {
    private $dao;

    public function __construct() {
        $this->dao = new UserDao();
    }

    public function get_all() {
        return $this->dao->getAll();
    }

    public function get_by_id($id) {
        return $this->dao->getById($id);
    }

    public function add($data) {
        if (empty($data['email']) || empty($data['full_name'])) {
            throw new Exception("Missing required fields: email or full_name");
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
