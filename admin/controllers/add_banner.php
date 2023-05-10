<?php
require "../../db_config.php";

$name = $_POST['name'];

$img = null;

if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
  $img = file_get_contents($_FILES['img']['tmp_name']);
}


$sql = "INSERT INTO banners (name, img) VALUES (?,?)";
$stmt = $pdo->prepare($sql);
$img_lob = $img . PDO::PARAM_LOB;
$stmt->execute([$name,$img_lob]);
header('Location: ../banners.php');
