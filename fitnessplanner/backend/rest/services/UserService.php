<?php
require_once 'BaseService.php';
require_once '../dao/UserDao.php';

class UserService extends BaseService {
  public function __construct() {
    parent::__construct(new UserDao());
  }
}
?>
