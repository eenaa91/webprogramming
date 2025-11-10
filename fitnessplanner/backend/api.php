<?php
require_once 'services/UserService.php';

header("Content-Type: application/json");

$service = new UserService();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  echo json_encode($service->getAll());
}
?>
