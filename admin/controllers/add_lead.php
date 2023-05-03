<?php
require "../../db_config.php";
$name = $_POST['name'];
$email = $_POST['email'];
$type = $_POST['type'];
$sql = "INSERT INTO leads (name, email, type) VALUES (?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $email, $type]);

echo ("
<script>
  window.location = '../../home.php';
  alert('Obrigado pelo cadastro, em breve entraremos em contato');
</script>
");
