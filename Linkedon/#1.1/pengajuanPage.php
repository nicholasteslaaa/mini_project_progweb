<?php
include "method.php";
$conn = openDB("localhost","root","","linkedon");

$tipe = companyOrClient($conn);
$email = getEmail($conn);
$row = $conn->query("SELECT * FROM $tipe WHERE _email = '$email'");
$nama = getName($conn,$email);
$name = "";
$namaPerusahaan = "";
$job = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "main_menu"){
            if ($tipe == "company"){
                header("location: main_page.php");
            }
            else if ($tipe == "client"){
                header("location: detail.php");
            }
        }

        
        
    }
    if (isset($_POST["Lamaran"])) {
        if ($_POST["Lamaran"] == "UnggahLamaran"){
            $detailrow = $conn->query("select * from detaillowongan")->fetch_assoc();
            $namaPerusahaan = $detailrow["_namaPerusahaan"];
            $job = $detailrow["_job"];
            $name = $_POST['name'];
            $alamat = $_POST['alamat'];
            $phone = $_POST['phone'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $cv = getPDF("pdf");

            if (checkCV($conn,$name,$namaPerusahaan,$job)){
                echo $nama." sudah pernah mendaftar sebagai ".$job." di ".$namaPerusahaan;
            }
            else {
                $conn->query("INSERT INTO cv VALUES('$name','$alamat','$phone','$dob','$email','$gender','$cv','$namaPerusahaan','$job')");
            }
            
        }
    }
    if (isset($_POST["Lowongan"])) {
        if ($_POST["Lowongan"] == "UnggahLowongan"){
            echo "berhasil";
            $nama = $_POST["namaPerusahaan"];
            $jobdesk = $_POST["jobdesk"];
            $deskripsi = $_POST["deskripsi"];
            $kualifikasi = $_POST["kualifikasi"];
            $keuntungan = $_POST["keuntungan"];
            $jenis = $_POST["jenis"];
            $lokasi = $_POST["lokasi"];
            $deadline = $_POST["deadline"];
            $remote = $_POST["remote"];
            $gaji = $_POST["gaji"];
            $gajiPer = $_POST["terimagaji"];
            $foto = getFile("../Images");

            $conn->query("INSERT INTO loker VALUES('$deskripsi','$kualifikasi','$nama','$gaji','$gajiPer','$foto','$deadline','$lokasi','$jenis','$remote','$jobdesk','$keuntungan')");
        }
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Lamaran</title>

    <style>

        /*Header*/
        header {
    background: #504B38;
    color: white;
    padding: 20px;
    text-align: center;
    position: relative;
}


        body {
            font-family: Arial, sans-serif;
            background-color: #F8F3D9;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #EBE5C2;
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #504B38;
        }
        label {
            display: block;
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
            color: #504B38;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #B9B28A;
            border-radius: 5px;
            background-color: #F8F3D9;
            color: #504B38;
        }
        .submit-btn {
            background-color: #504B38;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }
        .submit-btn:hover {
            background-color: #B9B28A;
        }
        .thank-you {
            display: none;
            margin-top: 20px;
            font-weight: bold;
            color: #504B38;
        }

        /*footer*/
    footer{
        text-align: center;
        background: #504B38; 
        color: white;
        padding: 20px;
        margin-top: 81px;
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
    width: 280px;
    height: 50px ;
}

.back-link:hover {
    background-color: white;
    color: black; /* Fix: Make text visible */
    
}

    </style>
</head>
<body>
    <header>
        <h1>Lowongan Pekerjaan</h1>
        <form action="" method="post"> 
            <input type="hidden" name="form_type" value="main_menu">
            <button type="submit" class="back-link">  	&lt; Kembali ke Halaman Utama </button>
        </form>
    </header>

    <?php 
    if ($tipe == "client"){
        echo "
            <div class='container'>
                <h1>Pengajuan Lamaran</h1>
                <form method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='Lamaran' value='UnggahLamaran'>

                    <label for='name'>Nama :</label>
                    <input type='text' id='name' name='name' value='$nama' required>

                    <label for='alamat'>Alamat :</label>
                    <input type='text' id='alamat' name='alamat' required>

                    <label for='phone'>Nomor Telepon :</label>
                    <input type='tel' id='phone' name='phone' required>

                    <label for='dob'>Tanggal Lahir :</label>
                    <input type='date' id='dob' name='dob' required>

                    <label for='email'>Email :</label>
                    <input type='email' id='email' name='email' value='$email' required>

                    <label for='gender'>Jenis Kelamin :</label>
                    <select name='gender' id='gender' required>
                        <option value='Laki-laki'>Laki-laki</option>
                        <option value='Perempuan'>Perempuan</option>
                    </select>

                    <label for='cv'>Unggah CV (PDF):</label>
                    <input id='cv' type='file' name='pdf' accept='.pdf' required>

                    <button type='submit' class='submit-btn'>Kirim Lamaran</button>
                </form>
                ";
            if (checkCV($conn,$name,$namaPerusahaan,$job)){
                echo "<p class='Terimakasih'> Terimakasih sudah memasukan lamaran🙏</p>";
            }
            echo "</div>";
        }
        
        if ($tipe == "company"){
            echo "
            <div class='container'>
                <h1>Buat Lowongan Kerja</h1>
                <form method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='Lowongan' value='UnggahLowongan'>

                    <label for='nama'>Nama Perusahaan : </label>
                    <input type='text' id='nama' name='namaPerusahaan' value='$nama' placeholder='Masukkan Nama Perusahaan' readonly required>

                    <label for='Jobdesk'>JobDesk : </label>
                    <input type='text' id='Jobdesk' name='jobdesk' placeholder='Masukkan JobDesk' required>
                    
                    <label for='deskripsi'>Deskripsi : </label>
                    <textarea name='deskripsi' id='deskripsi' cols='30' rows='10'></textarea>
                    
                    <label for='kualifikasi'>Kualifikasi : </label>
                    <textarea name='kualifikasi' id='kualifikasi' cols='30' rows='10'></textarea>

                    <label for='keuntungan'>Keuntungan : </label>
                    <textarea name='keuntungan' id='keuntungan' cols='30' rows='10'></textarea>

                    <label for='jenis'>Jenis : </label>
                    <select name='jenis' id='jenis' required>
                        <option value='Full Time'>Full Time</option>
                        <option value='Part Time'>Part Time</option>
                    </select>

                    <label for='gaji'>Gaji : </label>
                    <input type='number' id='gaji' name='gaji' placeholder='Masukan gaji' required>
                    
                    <label for='terimaGaji'>Terima gaji : </label>
                    <select name='terimagaji' id='terimaGaji' required>
                        <option value='Hari'>Per Hari</option>
                        <option value='Minggu'>Per Minggu</option>
                        <option value='Bulan'>Per Bulan</option>
                        <option value='Tahun'>Per Tahun</option>
                    </select>
                    
                    

                    <label for='lokasi'>lokasi : </label>
                    <input type='text' id='lokasi' name='lokasi' placeholder='Masukan alamat' required>
                    
                    <label for='deadline'>Deadline :</label>
                    <input type='date' id='deadline' name='deadline' required>
                    
                    <label for='remote'>Remote : </label>
                    <select name='remote' id='remote' required>
                        <option value='false'>tidak</option>
                        <option value='true'>ya</option>
                    </select>
                    
                    <label for='foto'>Unggah foto :</label>
                    <input type='file' name='image' id='foto' required>
                    
                    <button type='submit' class='submit-btn'>Unggah Lowongan</button>
                </form>
            </div>
            ";
        }
        ?>
        
    <footer>
        <p>&copy; 2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍</p>
    </footer>
        
</body>
</html>