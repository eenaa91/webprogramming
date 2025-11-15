<?php
require_once __DIR__ . '/BaseDao.php';



class UserDao extends BaseDao {

    public function __construct() {
        parent::__construct('users', 'user_id');
    }

  
    public function createUser($data) {
        return parent::insert($data);
    }


    public function getAllUsers() {
        return parent::getAll();
    }
  
    public function getUserById($id) {
        return parent::getById($id);
    }

    public function updateUser($id, $data) {
        return parent::update($id, $data);
    }

    public function deleteUser($id) {
        return parent::delete($id);
    }
}
?>
