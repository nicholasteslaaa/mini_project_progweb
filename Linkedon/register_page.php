
<?php
include "web/method.php";
require "web/DBconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $email = $_POST["Email"];
    $password = $_POST["password"];
    $namdep = $_POST["namaDepan"];
    $nambel = $_POST["namaBelakang"];
    $tanggalLahir = $_POST["tanggalLahir"];
    $alamat = $_POST["alamat"];
    $tipe_user = "client";
    
    
    
    if (checkUser($conn,$email,$tipe_user)){
        echo "email already registered in database";
    }
    else{
        $target_file = getFile("images/");
        if (registerClient($conn,$email,$password,$namdep,$nambel,$tanggalLahir,$alamat,$target_file,$tipe_user)){
            echo "Register successful!";
        }
        else{
            echo "Register faileds!";
        }
    }

    
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>

<style>
body {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 100vh; /* Full height of the viewport */
    margin: 0;
    background-color: #f9f3d9; /* Optional: Background color */
}
header {
    width: 100%;
    text-align: center;
    font-size: 2rem;
    padding: 20px;
    position: absolute; /* Keep header at the top */
    top: 0;

    background-color: #504b38;
    color: #fffdfd;
}

footer {
    width: 100%;
    text-align: center;
    font-size:larger;
    padding: 5px;
    position: absolute; /* Keep header at the top */
    bottom: 0;

    background-color: #504b38;
    color: #fffdfd;
}

fieldset{
    width: fit-content;
    color: black;
    height: fit-content;
    border-radius: 10%;
    padding: 5%;
    background-color: #ebe5c1;

    display: flex;
    flex-direction: column;
    text-align: center;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.815);
    
}
h1{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 150%;
    margin-top: 0%;
}
div input{
    font-family: Arial, Helvetica, sans-serif;
    width:300px;
    height:30px;
    background-color: #bab18d60;
    border-radius: 10%;
}
div{
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
div label{
    font-family: Arial, Helvetica, sans-serif;
    font-size:100%;
}
button{
    font-family: Arial, Helvetica, sans-serif;
    width: 100px;
    height: 40px;
    border-radius: 15%;
    background-color: #bab18d ;
    font-size: large;
    
}
p{
    width: 100%;
}
label{
    text-align: left;
}
</style>

<body>
    <header>
        <b>LinkedOn</b>
    </header>

    <form action="register_page.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <div>
                <table >
                        <thead>
                            <th colspan="2">
                                <h1>Register Page</h1>
                            </th>
                            <th>
                                
                                </th>
                        </thead>
                        <!-- email -->
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                            <td><input type="email" name="Email" id="email" required></td>
                        </tr>
                            
                        <!-- password -->
                        <tr>
                            <td><label for="pass">Password:</label></td>
                            <td><input type="password" name="password" id="pass" required></td>
                        </tr>
                        
                        <!-- nama Depan -->
                        <tr>
                            <td><label for="namaDpn">Nama Depan:</label></td>
                            <td><input type="text" name="namaDepan" id="namaDpn" maxlength="50" required></td>
                        </tr>
                        
                        <!-- nama Belakang -->
                        <tr>
                            <td><label for="namaBlkng">Nama Belakang:</label></td>
                            <td><input type="text" name="namaBelakang" id="namaBlkng" maxlength="50" required></td>
                        </tr>
                        
                        <!-- tanggal lahir -->
                        <tr>
                            <td><label for="tgllahir">Tanggal Lahir:</label></td>
                            <td><input type="date" name="tanggalLahir" id="tgllahir" required></td>
                        </tr>
                        
                        
                        <!-- alamat -->
                        <tr>
                            <td><label for="almt">Alamat:</label></td>
                            <td><input type="text" name="alamat" id="almt" required></td>
                        </tr>
                    
                        <!-- foto -->
                        <tr>
                            <td>
                                <label for="foto">Foto diri anda:</label>
                            </td>
                            <td>
                                <input type="file" name="image" id="foto" style="background-color:transparent"required>
                            </td>
                        </tr>
                    
                    
                    
                        <!-- button -->
                        <tr>
                            <td colspan="2">
                                <button type="reset">Reset</button>
                                <button type="submit">Submit</button>
                            </td>
                        </tr>
                    
                        <!-- Login page -->
                        <tr>
                            <td colspan="2">
                                <br>
                                Register as company: <a href="recruiter_register_page.php">Register here</a>
                                <br><br>
                                Already have an account?<a href="web/login_page.php"> login here</a>
                            </td>
                        </tr>
                </table>
            </div>
        </fieldset>
    </form>
    
    <img src="decoration/SHREK.png" width=350px alt="">

    <footer>
    2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍
    </footer>
</body>
</html>
