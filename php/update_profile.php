<?php
session_start();
include "config.php";

header("Content-Type: application/json");

if(!isset($_SESSION['user_id'])){
    echo json_encode([
        "status" => "error",
        "msg" => "Session habis, silakan login ulang."
    ]);
    exit;
}

$id = $_SESSION['user_id'];

$nama  = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');

if($nama === '' || $email === ''){
    echo json_encode([
        "status" => "error",
        "msg" => "Nama dan email tidak boleh kosong."
    ]);
    exit;
}

// keamanan dasar
$nama  = mysqli_real_escape_string($conn, $nama);
$email = mysqli_real_escape_string($conn, $email);

// update data
$query = mysqli_query($conn, "
    UPDATE user 
    SET nama = '$nama', email = '$email'
    WHERE ID_user = '$id'
");

if($query){
    echo json_encode([
        "status" => "success",
        "msg" => "Profil berhasil diperbarui."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Gagal memperbarui profil."
    ]);
}
