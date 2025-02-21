<?php
include "method.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linkedon";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $email = $_POST["Email"];
    $password = $_POST["password"];
    $namaperusahaan = $_POST["namaperusahaan"];
    $tanggalberdiri = $_POST["tanggalberdiri"];
    $alamat = $_POST["alamat"];
    $tipe_user = "Company";
    
    

    if (checkUser($conn,$email,$tipe_user)){
        echo "email already registered in database";
    }
    else{
        $filename = getFile("images/");
        registerCompany($conn,$email,$password,$namaperusahaan,$tanggalberdiri,$alamat,$filename,$tipe_user);

        if (checkUser($conn,$email,$tipe_user)){
            echo "Register Successful!";
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
    margin-top: 5%;
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

</style>

<body>
    <header>
        <!-- <img src="decoration/Linkedon logo.png" alt="Logo" width="150px"> -->
         <b>
             LinkedOn
         </b>
    </header>

    <form action="recruiter_register_page.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <!-- <legend align="center"><b>Company Register Page</b></legend> -->
            <div>
                <table>
                    <thead>
                        <th colspan="3">
                            <h1>Company Register Page</h1>
                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                    </thead>
                <tbody>

                    <!-- email -->
                    <tr>
                        <td>
                            <label for="email" >Email:</label>
                        </td>
                        <td>
                            <input type="email" name="Email" id="email" required>
                        </td>
                    </tr>
                    
                    <!-- password -->
                    <tr>
                    <td>
                        <label for="pass">Password:</label>
                    </td>
                    <td>
                        <input type="password" name="password" id="pass" required>
                    </td>
                </tr>
                
                <!-- nama Depan -->
                <tr>
                    <td>
                        <label for="namaperusahaan">Nama Perusahaan:</label>
                    </td>
                    <td>
                        <input type="text" name="namaperusahaan" id="namaperusahaan" maxlength="50" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <!-- tanggal lahir -->
                        <label for="tglberdiri">Tanggal Berdiri:</label>
                    </td>
                    <td>
                        <input type="date" name="tanggalberdiri" id="tglberdiri" required>
                    </td>
                </tr>
                
                <!-- alamat -->
                <tr>
                    <td>
                        <label for="almt">Alamat:</label>
                    </td>
                    <td>
                        <input type="text" name="alamat" id="almt" required>
                    </td>
                </tr>
                <!-- foto -->
                 <tr>
                    <td>
                        <label for="foto" >Logo Perusahaan:</label>
                    </td>
                    <td>
                        <input type="file" name="image" id="foto" style="background-color:transparent;width:180px;" required>
                    </td>
                </tr>
            </div>
            <!-- button -->
            <tr>
                <td colspan="2">
                    <button type="reset">Reset</button>
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </tbody>
        </table>
        
                <!-- Login page -->
                <p>
                    Register as Employee: <a href="register_page.php">Register here</a>
                </p>
                <p>
                    Already have an account?<a href="login_page.php"> login here</a>
                </p>
        </fieldset>
    </form>
            
            <img src="decoration/pepe.png" width="450px" alt="">

    <footer>
        Hello world
    </footer>
</body>
</html>
