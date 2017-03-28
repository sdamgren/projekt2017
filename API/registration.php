<?php
require('db.php');
if (isset($_POST['ffirstname'], $_POST['flastname'], $_POST['fpassword'], $_POST['femail'], $_POST['fphonenumber'], $_POST['faddress'], $_POST['fzipcode'], $_POST['fcity'], $_POST['fcountry'])) {
    $firstname = $_POST['ffirstname'];
    $lastname = $_POST['flastname'];
    $password = $_POST['fpassword'];
    $salt1 = "18gI%f5A";
    $salt2 = "@Y4p91bN";
    $salt_password = md5($salt1 . $password . $salt2);
    $email = ($_POST['femail'];
    $phonenumber = $_POST['fphonenumber'];
    $address = $_POST['faddress'];
    $zipcode = $_POST['fzipcode'];
    $city = $_POST['fcity'];
    $country = $_POST['fcountry'];
    // kolla om användaren finns i databasen genom att räkna antal rader i databastabellen där e-postadressen finns
    $sql = "SELECT COUNT(*) AS 'antal_rader' FROM `users`WHERE email = :email";
    $stm_count = $pdo->prepare($sql);
    $stm_count->execute(['email' => $_POST['femail']]);
    foreach ($stm_count as $row) {
        $antal_rader = $row['antal_rader'];
    }
    if ($antal_rader > 0) {
        echo json_encode(false);
    } else {
        //Lägg till användare i databasen
        $sql = "INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`, `phonenumber`, `address`, `city`, `zipcode`, `country`) VALUES (:firstname, :lastname, :password, :email, :phonenumber, :address, :city, :zipcode, :country) ";
        $stm_insert = $pdo->prepare($sql);
        $stm_insert->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => $salt_password,
            'email' => $email,
            'phonenumber' => $phonenumber,
            'address' => $address,
            'city' => $city,
            'zipcode' => $zipcode,
            'country' => $country]);
		header("Content-Type: application/json;charset=utf-8");
        echo json_encode(true);
    }
}