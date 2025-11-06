<?php
require_once 'BaseDao.php';

class WorkoutDao extends BaseDao {
  public function __construct() {
    parent::__construct('workout_plans');
  }
}
?>
