<?php
session_start();
if(!isset($_SESSION["user_idhd"])){
    header("Location: signin.php");
    exit;
}
?>