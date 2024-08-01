<?php
    $dsn = "mysql:host=localhost;dbname=bddiscussion;port=3306";
    $username = "root";
    $password = "@)@$";

    try{
        $conn = new PDO($dsn,$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXEPTION);
    } catch(PDOException $e){
        echo 'Connexion:'.$e->getMessage();
        exit;
    }
?>