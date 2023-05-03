<?php
require "../../db_config.php";
require "../../functions/update.php";
if (!empty($_GET['id'])) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categorie_id = $_POST['categorie_id'];
    $stars = $_POST['stars'];
    $id = $_POST['id'];
    $description = $_POST['description'];

    $img = null;

    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
      $img = file_get_contents($_FILES['img']['tmp_name']);
    }

    updateProduct($id, $name, $price, $categorie_id, $img, $stars, $description);
    header('Location: ../dashboard.php');
    exit();
  }
} else {
  header('Location: ../dashboard.php');
  exit();
}
