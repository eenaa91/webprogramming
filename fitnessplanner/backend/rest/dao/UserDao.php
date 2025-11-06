<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {

    public function __construct() {
        parent::__construct('users', 'user_id');
    }

    // ===== CRUD metode =====

    // CREATE
    public function createUser($data) {
        return parent::insert($data);
    }

    // READ (all)
    public function getAllUsers() {
        return parent::getAll();
    }

    // READ (by ID)
    public function getUserById($id) {
        return parent::getById($id);
    }

    // UPDATE
    public function updateUser($id, $data) {
        return parent::update($id, $data);
    }

    // DELETE
    public function deleteUser($id) {
        return parent::delete($id);
    }
}
?>
