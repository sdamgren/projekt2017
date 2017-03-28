<?php 
session_start();

if (isset ($_GET['id'])) {
  require 'db.php';

    $stm_select = $pdo->prepare('SELECT * FROM products WHERE id='.$_GET['id']);
    $stm_select->execute();
    
    foreach($stm_select as $row) {
       
        if(!empty($_SESSION['cart'])){
                $_SESSION['cart'][] = [ "item"=>$row, "quantity"=>1]; //Om det redan finns varor i varukorgen så lägger man till den nya produkten i arrayen
            } else {
                $_SESSION['cart'] = array( [ "item"=>$row, "quantity"=>1] ); //Om varukorgen är tom så skapas en array
            }
        
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($_SESSION['cart']);
        
    }
}   