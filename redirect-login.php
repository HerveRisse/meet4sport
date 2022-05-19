<?php 
    if(!isset($_SESSION['membre'])) {
        header('location:index.php');
    }
?>