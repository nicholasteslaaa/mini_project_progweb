<?php
//function
function permission($conn,$namaPerusahaan){
    if ($_SESSION["tipeUser"]=="company"){
        $currentnama = $conn->query("SELECT * FROM company where _email = '{$_SESSION['email']}'")->fetch_assoc()["_namaPerusahaan"];
        if ($namaPerusahaan == $currentnama){
            return true;   
        }
    }
    return false;
}
?>
<?php
include "method.php";
require "DBconnection.php";
session_start();

$namaperusahaan = $_SESSION["namaPerusahaan"]; 
$jobdesk = $_SESSION["job"];

$getInfo = $conn->query("select *,FORMAT(_gaji, 0, 'de_DE') AS gaji from loker where _namaPerusahaan = '$namaperusahaan' AND _job = '$jobdesk'");
$row = $getInfo->fetch_assoc();
$job = $row["_job"];
$KategoriJob = $row["_jobKategori"];
$deskripsi = $row["_deskripsi"];
$kualifikasi = $row["_kualifikasi"];
$gaji= $row["gaji"];
$gajiPer = $row["_gajiPer"];
$picture = $row["_pictpath"];
$deadline = $row["_deadline"];
$alamat = $row["_alamat"];
$tipe = $row["_tipe"];
$keuntungan = $row["_keuntungan"];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "main_menu"){
            header("location: main_page.php");
        }
    }
    if (isset($_POST["hapusLowongan"])) {
        if ($_POST["hapusLowongan"] == "hapus" && permission($conn,$namaperusahaan)){
            $conn->query("DELETE FROM loker WHERE _namaPerusahaan = '$namaperusahaan' and _job = '$jobdesk'");
            header("location: main_page.php");
        }
    }
    if (isset($_POST["editLowongan"])) {
        if ($_POST["editLowongan"] == "edit" && permission($conn,$namaperusahaan)){
            $_SESSION["job"] = $job;
            $_SESSION["edit"] = "true";
            header("location: pengajuanPage.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pekerjaan</title>
    <link rel="stylesheet" href="style/tampilan_halaman.css">
    <link rel="stylesheet" href="style/tampilan_detail.css">
    <link rel="shortcut icon" href="../Images/1740032207.jpg" type="image/x-icon">
</head>

<body>
    <header>
        <h1>Detail Pekerjaan</h1>
        <form action="" method="post"> 
            <input type="hidden" name="form_type" value="main_menu">
            <button type="submit" class="back-link">  	&lt; Kembali ke Halaman Utama </button>
        </form>

    </header>
    
    <div class="container">
        <div class="job-details">
            <h2>Software Engineer</h2>
            <table class = "main_table"> 
                <tr>
                    <td class="kolomtable">
                        <strong>Kategori </strong>
                    </td>
                    <td class="kolomtable">
                        <p><?php echo $KategoriJob; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="kolomtable">
                        <strong>Perusahaan </strong>
                    </td>
                    <td class="kolomtable">
                        <p><?php echo $namaperusahaan; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="kolomtable">
                        <strong>Jenis</strong>
                    </td>
                    <td class="kolomtable">
                        <p><?php echo $tipe; ?></php></p>
                    </td>
                </tr>
                <tr>
                    <td class="kolomtable">
                        <strong>Gaji</strong>
                    </td>
                    <td class="kolomtable">
                        <p><?php echo "Rp.".$gaji."/".$gajiPer;?></p>
                    </td>
                </tr>
                <tr class="kelompokTable1">
                    <td class="Tablelist">
                        <strong>Deskripsi Pekerjaan</strong>
                    </td>
                    <td class="panjanginSyarat">
                        <ul class="unorderedlist">
                        <?php echo $deskripsi;?>
                        </ul>
                    </td>
                </tr>
                <tr class="kelompokTable2">
                    <td class="Tablelist">
                        <strong>Kualifikasi</strong>
                    </td>
                    <td class="panjanginSyarat">
                        <ul class="unorderedlist">
                        <?php echo $kualifikasi;?>
                        </ul>
                    </td>
                </tr>
            </table>
        
            <?php
            
            if ($_SESSION["tipeUser"] == "client"){
                echo "<a href='pengajuanPage.php' class='apply-btn'>Ajukan Lamaran</a>";
            }
            else if (permission($conn,$namaperusahaan)){
                echo "<table>";
                echo "
                <tr>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='hapusLowongan' value='hapus'>
                            <button type='submit' class='apply-btn' style='background-color:#cf151e;color:white'>Hapus Lowongan</button>
                        </form>
                    </td>";
                echo "
                    <td>
                        <form method='post'>
                            <input type='hidden' name='editLowongan' value='edit'>
                            <button type='submit' class='apply-btn'>Edit</button>
                        </form>
                    </td>
                <tr>";
                echo "</table>";
            }
                
            
            ?>

        </div>
        <div class="job-sidebar">
            <h3>Informasi Tambahan</h3>
            <table>
                <tr>
                    <td>
                        <img src="<?php echo $picture ; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td class="kolomtablekecil">
                                    <strong>Lokasi</strong>
                                </td>
                                <td class="kolomtablekecil">
                                    <p><?php echo $alamat ; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="kolomtablekecil">
                                    <strong>Deadline</strong>
                                </td>
                                <td class="kolomtablekecil">
                                    <p><?php echo $deadline; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="kolomtablekecil">
                                    <strong>Keuntungan</strong>
                                </td>
                                <td class="kolomtablekecil">
                                    <p><?php echo $keuntungan; ?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php
        if (permission($conn,$namaperusahaan)){
            $result = $conn->query("SELECT * FROM cv WHERE _namaPerusahaan = '$namaperusahaan' AND _job = '$jobdesk'");
            if ($result->num_rows > 0) {
                echo "<div class='job-container'>";
            echo "<table class='CV' align='center'>";
            echo "
                <thead>
                    <th>nama</th>
                    <th>alamat</th>
                    <th>nomor HP</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>cv</th>
                    <th>JobDesk</th>  
                </thead>
            ";
            while ($row = $result->fetch_assoc()) {
                echo"<tr>
                        <td>{$row['_nama']}</td>
                        <td>{$row['_alamat']} </td>
                        <td>{$row['_noTelp']} </td>
                        <td>{$row['_email']} </td>
                        <td>{$row['_gender']} </td>
                        <td><a href=\"" . $row['_cv'] . "\" download class='download-btn'>Download pdf</a></td>
                        <td>{$row['_job']} </td>
                    </tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p style='text-align:center'>Belum ada lamaran <p>";
            }
            closeDB($conn);
        }
    ?>





    <footer class="footer">
        <p>&copy; 2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍</p>
    </footer>
</body>
</html>
