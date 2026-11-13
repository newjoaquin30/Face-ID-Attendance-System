<?php 
    require_once "./php/admin.php";
    require_once "./php/database.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM `register-form` WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $sm = "Successfully Deleted Account.";
        header("Location: admin-details.php?success=$sm");
    }
?>