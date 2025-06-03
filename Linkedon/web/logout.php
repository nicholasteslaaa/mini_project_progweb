<?php
session_start();
session_destroy();
setcookie("email","", time() -3660,"/");
header("Location:login_page.php");
?>