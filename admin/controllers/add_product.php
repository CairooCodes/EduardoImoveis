<?php
require "../../db_config.php";

$name = $_POST['name'];
$price = $_POST['price'];
$categorie_id = $_POST['categorie_id'];
$link = $_POST['link'];
$endereco = $_POST['endereco'];
$zona = $_POST['zona'];
$metro_quadrado = $_POST['metro_quadrado'];
$bairro = $_POST['bairro'];
$quartos = $_POST['quartos'];
$description = $_POST['description'];
$imagens = [];

$dom = new DOMDocument();
$dom->loadHTML($description);

$img = null;

if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
  $img = file_get_contents($_FILES['img']['tmp_name']);
}

if (!empty($_FILES['imagens']['tmp_name'][0])) {
  foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
    $imagens[] = file_get_contents($_FILES['imagens']['tmp_name'][$key]);
  }
}

$new_description = $dom->saveHTML();

$sql = "INSERT INTO products (name, price, img, images, categorie_id, link, endereco,zona,quartos,bairro,metro_quadrado,description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$img_lob = $img . PDO::PARAM_LOB;
$imgs = serialize($imagens) . PDO::PARAM_LOB;
$stmt->execute([$name, $price, $img_lob, $imgs, $categorie_id, $link, $endereco, $zona, $quartos, $bairro, $metro_quadrado, $description]);
header('Location: ../dashboard.php');
