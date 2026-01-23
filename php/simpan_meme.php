<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    echo "Session habis";
    exit;
}

$id_user = $_SESSION['user_id'];

$judul = mysqli_real_escape_string($conn, $_POST['judul']);
$desk  = mysqli_real_escape_string($conn, $_POST['desk']);
$pic   = mysqli_real_escape_string($conn, $_POST['pic']);
$url   = $pic;

if(empty($judul) || empty($desk) || empty($pic)){
    echo "Semua field wajib diisi";
    exit;
}

$query = mysqli_query($conn, "
    INSERT INTO meme (judul, desk, pic, url, ID_user)
    VALUES ('$judul', '$desk', '$pic', '$url', '$id_user')
");

if($query){
    echo "success";
} else {
    echo "Gagal menyimpan meme";
}
