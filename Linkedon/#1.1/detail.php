<?php
include "method.php";
$conn = openDB("localhost","root","","linkedon");

$detail = $conn->query("select * from detaillowongan");
$rowdetail = $detail->fetch_assoc();
$namaperusahaan = $rowdetail["_namaPerusahaan"];
$jobdesk = $rowdetail["_job"];


$getInfo = $conn->query("select *,FORMAT(_gaji, 0, 'de_DE') AS gaji from loker where _namaPerusahaan = '$namaperusahaan'");
$row = $getInfo->fetch_assoc();
$job = $row["_job"];
$deskripsi = $row["_deskripsi"];
$kualifikasi = $row["_kualifikasi"];
$gaji= $row["gaji"];
$gajiPer = $row["_gajiPer"];
$picture = $row["_pictpath"];
$deadline = $row["_deadline"];
$alamat = $row["_alamat"];
$tipe = $row["_tipe"];
$remote = $row["_remote"];
$keuntungan = $row["_keuntungan"];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "main_menu"){
            truncateTable($conn,"detaillowongan");
            header("location: main_page.php");
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
    <link rel="shortcut icon" href="../Images/1740032207.jpg" type="image/x-icon">
</head>

<style>

body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
    background-color: #F8F3D9;
    color: #333;
}

header {
    background: #504B38;
    color: white;
    padding: 20px;
    text-align: center;
    position: relative;
}

.main_table{
    border-collapse: collapse;
}

.main_table td:nth-child(2) {
    width: 70%;
}

img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .back-link {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    background-color: transparent;
    border: none;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 15px;
    border-radius: 5px;
    display: inline-block; /* Ensures the button behaves like a button */
    cursor: pointer;
    transition: background 0.3s ease, color 0.3s ease;
}

.back-link:hover {
    background-color: white;
    color: black; /* Fix: Make text visible */
    
}

.container {
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 40px;
    flex-wrap: wrap;
}

.job-details, .job-sidebar {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.job-details {
    width: 60%;
}

.job-sidebar {
    width: 30%;
    background: #EBE5C2;
}

.job-details h2, .job-sidebar h3 {
    color: #504B38;
}

.apply-btn {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 15px;
    background: #B9B28A;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
}

.apply-btn:hover {
    background: #A89E79;
}

.footer {
    width: 100%;
    text-align: center;
    font-size:larger;
    padding: 5px;
    position: absolute; /* Keep header at the top */
    bottom: auto;

    background-color: #504b38;
    color: #fffdfd;
}

.kolomtable{
    width: 35vh;
}

.unorderedlist{
    list-style-position: inside;
}

.unorderedlist li::marker{
    font-weight: bold;
}

.Tablelist{
    vertical-align: top;
}

.kelompokTable1{
    border: 0;
    background-color: rgba(128, 128, 128, 0.264);
}

.kelompokTable2{
    border: 0;
    background-color: rgba(57, 44, 0, 0.186);
}

.panjanginSyarat{
    width: 100vh;
}

.kolomtablekecil{
    width: 16vh;
}

.CV {
    border: 2px solid black; /* Outer border for the table */
    border-collapse: collapse; /* Merge cell borders */
    width: 80%; /* Adjust width if needed */
    margin-top: 20px;
}

.CV th, .CV td {
    border: 1px solid black; /* Borders for each cell */
    padding: 10px; /* Add spacing inside cells */
    text-align: left; /* Align text */
}

.CV thead {
    background-color: #504B38; /* Header background */
    color: white; /* Header text color */
}

.download-btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
}

.download-btn:hover {
    background-color: #218838;
}

</style>

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

            <a href="pengajuanPage.php" class="apply-btn">Ajukan Lamaran</a>
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
        if (companyOrClient($conn)=="company"){
        $curEmail = $conn->query("SELECT * FROM current_company")->fetch_assoc()["_email"];
        $currentnama = $conn->query("SELECT * FROM company where _email = '$curEmail'")->fetch_assoc()["_namaPerusahaan"];

        if ($namaperusahaan == $currentnama){

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
            echo "No records found";
        }
        $conn->close();
            }
        }
    ?>





    <footer class="footer">
        <p>&copy; 2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍</p>
    </footer>
</body>
</html>
