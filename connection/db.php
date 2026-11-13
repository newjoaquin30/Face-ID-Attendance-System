<?php 
    $db_host = "127.0.0.1";
    $db_user = "joaqz";
    $db_pass = "1030";
    $db_name = "face_id_management_system";

    try{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo"Connection failed." . $e->getMessage();
    }
?>