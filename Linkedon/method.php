<?php
function DeleteAccount($conn,$curEmail,$usertype){
    $conn->query("Delete from $usertype where _email = '$curEmail'");
    truncateTable($conn,"current_".$usertype);
}

function truncateTable($conn,$usertype) {
    $conn->query("truncate table $usertype");
   
}

function registerClient($conn,$email,$password,$namdep,$nambel,$tanggalLahir,$alamat,$target_file,$tipe_user){
    $conn->query("INSERT INTO client VALUES('$email','$password','$namdep','$nambel','$tanggalLahir','$alamat','$target_file','$tipe_user')");
    return checkUser($conn,$email,$tipe_user);
}
function registerCompany($conn,$email,$password,$namaperusahaan,$tanggalberdiri,$alamat,$target_file,$tipe_user){
    $conn->query("INSERT INTO company VALUES('$email','$password','$namaperusahaan','$tanggalberdiri','$alamat','$target_file','$tipe_user')");
    return checkUser($conn,$email,$tipe_user);
}

function getName($conn,$email){
    $row = $conn->query("SELECT _namadepan,_namabelakang from client where _email = '$email'");
    $row = $row->fetch_assoc();
    return $row["_namadepan"]." ".$row["_namabelakang"];
}

function checkUser($conn,$email,$tipe_user){
    $check = $conn->query("SELECT * FROM $tipe_user WHERE _email = '$email'");
    return $check->num_rows > 0;
}

function getFile($folder){
    $target_dir = $folder."/";
    // Get file extension
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    // Generate a unique filename using timestamp
    $new_filename = time() . "." . $file_extension;
    $target_file = $target_dir . $new_filename; // pict path
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    return $target_file;
}

function openDB($servername,$username,$password,$dbname){
    $conn = new mysqli($servername,$username,$password,$dbname);
    return $conn;
}

?>