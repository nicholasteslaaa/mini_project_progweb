<?php
include "method.php";
$conn = openDB("localhost","root","","linkedon");

$conn->query("truncate table current_client");
$conn->query("truncate table current_company");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $checkclient = $conn->query("select * from client where _email = '$email' and _password = '$password'");
    $checkcompany = $conn->query("select * from company where _email = '$email' and _password = '$password'");
    if ($checkclient->num_rows > 0){
        $conn->query("insert into current_client values('$email')");
        header("Location: main_page.php");
        exit();
    }
    else if ($checkcompany->num_rows > 0){
        $conn->query("insert into current_company values('$email')");
        header("Location: recruiter_main_page.php");
        exit();
    }
    else{
        echo "Email not found!";
    }
    


$conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    font-size: 300%;
    margin-top: -10%;
}
div input{
    font-family: Arial, Helvetica, sans-serif;
    width:300px;
    height:40px;
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
    font-size:x-large;
}
button{
    font-family: Arial, Helvetica, sans-serif;
    width: 150px;
    height: 40px;
    border-radius: 15%;
    background-color: #bab18d ;
    font-size: x-large;
}
</style>

<body>
    <header>
        <b>
            LinkedOn
        </b>
    </header>

    <fieldset>
        <h1>Login Page</h1>    
        <form action="" method="post">
            
            <div>
                <label for="Email" class="label" style="text-align: left;"> Email:</label>
                <br>
                <input type="email" name="email" id="Email" class="input_box" placeholder="Masukan email anda disini" required>
                <label for="Password" class="label">Password:</label>
                <br>
                <input type="password" name="password" id="Password" class="input_box" placeholder="Masukan password anda disini" required>
            </div>
                <br>
                <button type="submit" class="login_button">Login</button>
                <br>
                <p>Don't have an account yet? <a href="register_page.php">Register here</a></p>
            </form>
        </fieldset>
        
        <aside >
            <img src="decoration/ChillGuy.png" width="300px" alt="">
        </aside>
    
        <footer>
            Hello World
        </footer>
</body>
</html>