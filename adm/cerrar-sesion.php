<?php 
session_start();


if(!isset($_SESSION['idUser'])){
    header('location:../index.php');
}

unset($_SESSION['idUser']);

session_destroy();

header('location:login-adm.php');

?>