<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["tipeUser"]);
setcookie("email","", time() -3660,"/");
header("Location:login_page.php");
?>