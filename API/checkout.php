<?php

require("db.php");
require("auth.php");

$email = $_SESSION['email']; //sparar den e-post som användaren är inloggad på
$datetime = date("Y-m-d H:i:s"); //Datum i datetime-format

if( isset($_POST['submit']) ) {
    foreach($_SESSION['cart'] as $result) { //Loopar igenom sessionen (som är en array)
        $name = $result["item"]["name"]; //Hämtar värdet (name) från nyckeln (item)
        $price = $result["item"]["price"];
        $sql = "INSERT INTO `order` (name, date, email, total) VALUES ('$name', '$datetime', '$email', '$price')"; //Lägger in alla produkter från varukorgen till databasen 
        $stm_insert = $pdo->prepare($sql);
        $stm_insert->execute();
    }
unset($_SESSION['cart']); //Tar bort produkterna i varukorgen efter slutfört köp

header("Content-Type: application/json;charset=utf-8");
echo json_encode(true);
}
        