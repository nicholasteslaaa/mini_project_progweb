<?php
include "method.php";
require "DBconnection.php";
session_start();

if (isset($_SESSION["email"]) && isset($_SESSION["tipeUser"])) {
    header("Location: main_page.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $tipe = getTypeFromEmail($conn,$email);
        
        if ($tipe != null){
            $checkclient = $conn->query("select * from $tipe where _email = '$email' and _password = '$password'");
            if ($checkclient->num_rows > 0){
                $_SESSION["email"] = $email;
                $_SESSION["tipeUser"] = $tipe;
                setcookie("email", $email, time()+ 60*60*24,"/");
                header("Location: main_page.php");
                exit();
            }
        }
        else{
            echo "Email not found!";
        }
    }
}
closeDB($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tampilan_halaman.css">
    <link rel="stylesheet" href="style/tampilan_login.css">
    <title>Document</title>
</head>

<body>
    <header>
           <h1>LinkedOn</h1>
    </header>

    <table>
            <tr>
                <td>
                    <table>
                        <thead>
                            <th><h1>Login Page</h1></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="" method="post"> 
                                <tr>
                                    <td>
                                        <label for="Email" class="label" style="text-align: left;"> Email:</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="email" name="email" id="Email" class="input_box" placeholder="Masukan email anda disini" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="Password" class="label">Password:</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="password" name="password" id="Password" class="input_box" placeholder="Masukan password anda disini" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="submit-bton">Login</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Don't have an account yet? <a href="../register_page.php">Register here</a></p>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </td></tr></table>
                </td>
                <td>
                    <img src="../decoration/ChillGuy.png" width="300px" alt="">
                </td>
            </tr>
    </table>
    
    <footer>
        2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍
        </footer>
    </body>
</html>