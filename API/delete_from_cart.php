<?php
session_start();


require 'db.php';

echo json_encode(array_splice($_SESSION['cart'], 0, 1));