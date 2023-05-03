<?php
require "../../db_config.php";

// Verificar se o ID do cliente foi enviado
if (!empty($_GET['id'])) {
  // Obter o ID do cliente
  $id = $_GET['id'];
  deleteProduct($id);
  header('Location: ../dashboard.php');
  exit();
} else {
  // Redirecionar para a página de lista de clientes se o ID do cliente não for fornecido
  header('Location: ../dashboard.php');
  exit();
}

// Função para excluir um cliente pelo ID
function deleteProduct($id)
{
  global $pdo;
  $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}
