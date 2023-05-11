<?php
require "../../db_config.php";
require "../../functions/update.php";
if (!empty($_GET['id'])) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categorie_id = $_POST['categorie_id'];
    $id = $_POST['id'];
    $endereco = $_POST['endereco'];
    $zona = $_POST['zona'];
    $metro_quadrado = $_POST['metro_quadrado'];
    $bairro = $_POST['bairro'];
    $quartos = $_POST['quartos'];
    $description = $_POST['description'];

    $img = null;

    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
      $img = file_get_contents($_FILES['img']['tmp_name']);
    }

    updateProduct($id, $name, $price, $categorie_id, $img, $endereco, $zona, $metro_quadrado, $bairro, $quartos, $description);
    header('Location: ../dashboard.php');
    exit();
  }
} else {
  header('Location: ../dashboard.php');
  exit();
}
