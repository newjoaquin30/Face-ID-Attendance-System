<?php
    $host_server = "127.0.0.1";
    $host_user = "joaqz";
    $host_pass = "1030";
    $host_name = "face_id_management_system";
    
    try{
    $conn = new PDO("mysql:host=$host_server;dbname=$host_name", $host_user, $host_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo"Connection failed." . $e->getMessage();
    }
?>