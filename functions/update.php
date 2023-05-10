<?php
function updateProduct($id, $name, $price, $categorie_id, $img, $stars, $description)
{
  global $pdo;
  if ($img) {
    $img_lob = $img . PDO::PARAM_LOB;
    $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, categorie_id = :categorie_id, stars = :stars, img=:img, description=:description WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':categorie_id', $categorie_id);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':stars', $stars);
    $stmt->bindValue(':img', $img_lob, PDO::PARAM_LOB);
    $stmt->bindParam(':id', $id);
  } else {
    $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, categorie_id = :categorie_id, stars = :stars, description=:description WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':categorie_id', $categorie_id);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':stars', $stars);
  }
  $stmt->execute();
}

function updateBanner($id, $name, $img)
{
  global $pdo;
  if ($img) {
    $img_lob = $img . PDO::PARAM_LOB;
    $stmt = $pdo->prepare("UPDATE banners SET name = :name, img=:img WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindValue(':img', $img_lob, PDO::PARAM_LOB);
    $stmt->bindParam(':id', $id);
  } else {
    $stmt = $pdo->prepare("UPDATE banners SET name = :name WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
  }
  $stmt->execute();
}

function updateCategorie($id, $name)
{
  global $pdo;
  if ($id) {
    $stmt = $pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
  } else {
    $stmt = $pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
  }
  $stmt->execute();
}