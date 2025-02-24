<?php
include "method.php";
$conn = openDB("localhost","root","","linkedon");
$tipe = companyOrClient($conn);
$current = $conn->query("select * from current_$tipe");
$curRow = $current->fetch_assoc();
$curEmail = $curRow["_email"];

$result = $conn->query("select * from $tipe where _email = '$curEmail'");
$row = $result->fetch_assoc();
$usertype = $row["_user_type"];
$curusertype = "current_".$row["_user_type"];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "deleteAccount"){
            DeleteAccount($conn,$curEmail,$usertype);
            header("location: login_page.php");
        }
        if ($_POST["form_type"] == "logout"){
            truncateTable($conn,$curusertype);
            header("location: login_page.php");
        }    
    }
    if (isset($_POST["detailLowongan"])) {
        truncateTable($conn,"detaillowongan");
        list($namaPerusahaan, $job) = explode("|", $_POST["detailLowongan"]);
        $conn->query("INSERT INTO detaillowongan values('$namaPerusahaan','$job',false)");
        header("location: detail.php");
    }
    if (isset($_POST["buatLowongan"])) {
        header("location: pengajuanPage.php");
    }
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
    /*semua*/
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }
    
    /* body*/
    body{
        background-color: #F8F3D9; 
        
    }
    
    /*Header*/
    header{
        background: #504B38; 
        color: white;
        padding: 15px;
        text-align: center;
    }

    footer {
    width: 100%;
    text-align: center;
    font-size:larger;
    padding: 5px;
    position: absolute; /* Keep header at the top */
    bottom: auto;

    background-color: #504b38;
    color: #fffdfd;
    }


    header a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        float: right;
        margin-right: 20px;
    }

    .logout-button{
        width: 160px;
        height: fit-content;
        background: #B9B28A;
        color: black;
        border: black;
        cursor: pointer;
        border-radius: 20px;
        margin-top: 10px;
        margin-bottom: 0px  ;
        padding: 10px;

        font-size: larger;
    }
    .Account{
        width: 160px;
        height: fit-content;
        top: 33px;
        right: 20px;
        background: #B9B28A;
        color: black;
        border: black;
        cursor: pointer;
        border-radius: 20px;
    }
    
    
    /*bawahnya*/
    .hero{
        background: url("../Images/Brown Organic Abstract Zoom Virtual Background (1).png") no-repeat center center/cover;
        color: black;
        text-align: center;
        padding: 50px 20px;;
    }
    
    .hero h2 {
        font-size: 40px;
    }
    
    /*Form Pencarian*/
    .search-box{
        text-align: center;
        margin: 20px 0;
    }
    
    .search-box input {
        width: 50%;
        padding: 10px;
        border: 1px solid #B9B28A;
        border-radius: 5px;
    }
    
    .search-box button {
        padding: 10px 15px;
        background: #B9B28A; 
        color: black;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }
    
    /*DAFTAR LOWONGAN*/
    .job-container{
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        padding: 20px;
    }
    
    .job-item{
        background: #EBE5C2;
        border: 1px solid #B9B28A;
        padding: 15px;
        width: 300px;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        text-align: center;
        border-radius: 5px;
    }
    
    .job-item h3 {
        font-size: 14px;
        color: #504B38;
    }
    
    .job-item p {
        font-size: 14px;
        color: #504B38;
    }
    
    .btn{
        display: inline-block;
        margin-top: 10px;
        padding: 10px;
        background: #B9B28A;
        color: black;
        text-decoration: dashed;
        border-radius: 5px;
    }
    
    /*footer*/
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



.dropbtn {
  background-color:transparent;
  color: white;
  border-radius: 100%;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: absolute;
    top: 1px;
    right: 10px;
    /* transform: translateY(-50%); */
    color: black;
    border: black;
    cursor: pointer;
    border-radius: 5px;
    /* text-decoration:none; */
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  right: 1px;
  background-color: transparent;
  border-radius: 15%;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color:rgba(80, 75, 56, 0.77);}
</style>

<body>
    <header>
        <span><h1 style="text-align:left">
            <b>LinkedOn</b>
        </h1></span>
        <div class="dropdown">
            <button class="dropbtn"><img src="../decoration/menuHamburger.png" width="50px" alt=""></button>
            <div class="dropdown-content">
                <form action="" method="post"> 
                    <input type="hidden" name="form_type" value="Account">
                    <button type="submit" class="Account">
                        <table>
                                <td>
                                    <img src="../decoration/profile.png" width="60px" alt="">
                                </td>
                                <td>
                                    <?php echo getName($conn,$curEmail);?>
                                </td>
                        </table>
                    </button>
                </form>
                <?php 
                if ($usertype == "Company"){
                    echo "
                    <form action='' method='post'>
                        <input type='hidden' name='buatLowongan' value='Lowongan'>
                        <button type='submit' class='logout-button' style='background-color:limegreen'>Buat Lowongan</button>
                    </form>";
                }
                ?>
                <form action="" method="post"> 
                    <input type="hidden" name="form_type" value="deleteAccount">
                    <button type="submit" class="logout-button">Delete Account</button>
                </form>
                <form action="" method="post"> 
                    <input type="hidden" name="form_type" value="logout">
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div> 
        <h1>Lowongan Pekerjaan</h1>
    </header>
    
    <div class="hero">
        <h2>Temukan Pekerjaan Impianmu!!</h2>
        <h4>Mulai Karirmu Sekarang</h4>
    </div>
    <div class="search-box">
        <input type="text" placeholder="Cari nama perusahaan...">
        <button>Cari</button>
    </div>

        
        <?php
        $result = $conn->query("SELECT *,FORMAT(_gaji, 0, 'de_DE') AS gaji FROM loker");
        if ($result->num_rows > 0) {
            $counter = 0;
            echo "<div class='job-container'>";
            while ($row = $result->fetch_assoc()) {
                $pict = $row['_pictpath'];
                echo"<div class='job-item'>
                            <td><img src='$pict' alt='' width = 150px></td>
                            <h2><b>{$row['_job']}</b></h2>
                            <p>Perusahaan: {$row['_namaPerusahaan']}</p>
                            <p>Jenis: {$row['_tipe']}</p>
                            <p>Gaji: Rp {$row['gaji']}/{$row['_gajiPer']}</p>
                            <form action='' method='post'> 
                                <input type='hidden' name='detailLowongan' value='" . htmlspecialchars($row["_namaPerusahaan"] . "|" . $row["_job"], ENT_QUOTES, 'UTF-8') . "'>
                                <button type='submit' class='btn'>Lihat Detail</button>
                            </form>
                        </div>
                        ";
                }
            echo "</div>";
        } else {
            echo "No records found";
        }
        $conn->close();
        ?>
    <footer>
    2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍
    </footer>
</body>
    </html>