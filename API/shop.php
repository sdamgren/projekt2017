<?php

require 'db.php';

//VISAR ALLA PRODUKTER SOM FINNS

$stm_select = $pdo->prepare('SELECT `name`, `price`, `description`, `pic` FROM `products`');
$stm_select->execute([]);
$result = array();

$stm_select->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json;charset=utf-8");
echo json_encode($result, JSON_UNESCAPED_UNICODE);
