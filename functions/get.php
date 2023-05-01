<?php

function getAllProducts()
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products order by id desc");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProducts()
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products where categorie_id = 1 order by id desc");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProducts2()
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products where categorie_id = 9 order by id desc");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProducts3()
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products where categorie_id = 2 order by id desc");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategories()
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM categories order by id desc");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}