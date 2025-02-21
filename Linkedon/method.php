<?php
function DeleteAccount($conn,$curEmail,$usertype){
    $conn->query("Delete from company where _email = '$curEmail'");

    truncateTable($conn,$usertype);
}

function truncateTable($conn,$usertype) {
    $conn->query("truncate table $usertype");
   
}

function registerCompany($conn,$email,$password,$namaperusahaan,$tanggalberdiri,$alamat,$target_file,$tipe_user){
    $conn->query("INSERT INTO company VALUES('$email','$password','$namaperusahaan','$tanggalberdiri','$alamat','$target_file','$tipe_user')");
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

?>