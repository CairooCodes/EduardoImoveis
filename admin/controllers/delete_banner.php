<?php
require "../../db_config.php";

// Verificar se o ID do banner foi enviado
if (!empty($_GET['id'])) {
  // Obter o ID do banner
  $id = $_GET['id'];
  deleteProduct($id);
  header('Location: ../banners.php');
  exit();
} else {
  // Redirecionar para a página de lista de banners se o ID do banner não for fornecido
  header('Location: ../banners.php');
  exit();
}

// Função para excluir um banner pelo ID
function deleteProduct($id)
{
  global $pdo;
  $stmt = $pdo->prepare("DELETE FROM banners WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}
