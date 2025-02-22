<?php
include "method.php";
$conn = openDB("localhost","root","","linkedon");

$current = $conn->query("select * from current_company");
$curRow = $current->fetch_assoc();
$curEmail = $curRow["_email"];

$result = $conn->query("select * from company where _email = '$curEmail'");
$row = $result->fetch_assoc();
$curusertype = "current_".$row["_user_type"];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "deleteAccount"){
            DeleteAccount($conn,$curEmail,$curusertype);
            header("location: login_page.php");
        }
        if ($_POST["form_type"] == "logout"){
            truncateTable($conn,"current_company");
            header("location: login_page.php");
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
    <title>Document</title>
</head>
<body>
    <p>Nama Perusahaan: <?php echo $row["_namaPerusahaan"];?></p>

<table>
    <tr>
        <td>
            <fieldset>
                <table>
                    <tr>
                            <legend align="center"> Ceritanya profil</legend>
                            <td>
                                <img src="<?php echo $row["_pictpath"];?>" alt="" width="250px">
                            </td>
                        </tr>
                    </table>
                </fieldset>
        </td>
    </tr>
</table>
    <form action="" method="post"> 
        <input type="hidden" name="form_type" value="deleteAccount">
        <button type="submit">Delete Account</button>
    </form>
    <form action="" method="post"> 
        <input type="hidden" name="form_type" value="logout">
        <button type="submit">Logout</button>
    </form>

</body>
</html>