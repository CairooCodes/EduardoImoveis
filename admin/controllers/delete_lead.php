<?php
require "../../db_config.php";

if (!empty($_GET['id'])) {
  $id = $_GET['id'];
  deleteLead($id);
  header('Location: ../leads.php');
  exit();
} else {
  header('Location: ../leads.php');
  exit();
}

function deleteLead($id)
{
  global $pdo;
  $stmt = $pdo->prepare("DELETE FROM leads WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}
