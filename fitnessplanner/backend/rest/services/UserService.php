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

        // basic validation
        if (empty($data['email']) || empty($data['full_name'])) {
            throw new Exception("Email and full_name are required");
        }

        // duplicate email check
        if ($this->dao->get_user_by_email($data['email'])) {
            throw new Exception("Email already in use.");
        }

        // hash password if provided
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        // default role = user
        if (empty($data['role'])) {
            $data['role'] = "user";
        }

        return $this->dao->insert($data);
    }

    public function update($id, $data) {

        $existing = $this->dao->getById($id);
        if (!$existing) {
            throw new Exception("User not found");
        }

        $loggedUser = Flight::get('user');

        if ($loggedUser->role !== "admin") {
            unset($data['role']); 
        }

        if (isset($data['password']) && $data['password'] !== null && $data['password'] !== "") {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        if (isset($data['email']) && $data['email'] !== $existing['email']) {
            if ($this->dao->get_user_by_email($data['email'])) {
                throw new Exception("Email already in use.");
            }
        }

        return $this->dao->update($id, $data);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
?>
