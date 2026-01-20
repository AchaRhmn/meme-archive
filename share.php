<?php
session_start();
include "php/config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit;
}

$id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT nama, email FROM user WHERE ID_user='$id'");
$user  = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Meme Archive | Share Meme</title>

    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #111;
        }

        .main-content-wrapper {
            flex: 1;
            background: linear-gradient(135deg, #111, #1e1e1e);
        }

        .share-wrapper {
            background: rgba(255,255,255,0.97);
            border-radius: 12px;
            padding: 40px 35px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.4);
        }

        .share-wrapper h3 {
            color: #222;
            font-weight: 600;
        }

        .share-wrapper p {
            color: #555;
            font-size: 14px;
        }

        .form-control {
            background: #f6f6f6;
            border: 1px solid #ddd;
            color: #333;
        }

        .form-control:focus {
            background: #fff;
            border-color: #fbb710;
            box-shadow: none;
        }

        .preview-box {
            display: none;
            margin-top: 20px;
            padding: 15px;
            border: 1px dashed #ccc;
            text-align: center;
        }

        .preview-box img {
            max-width: 100%;
            border-radius: 8px;
        }

        footer {
            background: #000;
            padding: 15px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 13px;
            color: #aaa;
        }
    </style>
</head>

<body>

<div class="main-content-wrapper d-flex clearfix">

    <!-- MOBILE NAV -->
    <div class="mobile-nav">
        <div class="amado-navbar-brand">
            <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
        </div>
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- HEADER -->
    <header class="header-area clearfix">
        <div class="nav-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>

        <div class="logo">
            <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
        </div>
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li  class="active"><a href="share.php">Share meme</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
    </header>

    <!-- SHARE MEME -->
    <div class="cart-table-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-7">
                    <div class="share-wrapper">

                        <h3 class="text-center mb-2">Share Your Meme</h3>
                        <p class="text-center mb-4">
                            Unggah meme kamu dan ceritakan asal-usul serta alasan meme tersebut bisa viral.
                        </p>

                        <!-- ALERT -->
                        <div id="alertBox"></div>

                        <!-- FORM -->
                        <form id="shareForm">

                            <div class="form-group">
                                <label>Judul Meme</label>
                                <input type="text" class="form-control" id="memeTitle">
                            </div>

                            <div class="form-group">
                                <label>Kategori Meme</label>
                                <select class="form-control" id="memeCategory">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option>Classic Meme</option>
                                    <option>Reaction Meme</option>
                                    <option>Gaming Meme</option>
                                    <option>Anime Meme</option>
                                    <option>Dark Humor</option>
                                    <option>Indonesian Meme</option>
                                    <option>Random Meme</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Asal Usul Meme</label>
                                <textarea class="form-control" id="memeOrigin" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Kenapa Bisa Terkenal?</label>
                                <textarea class="form-control" id="memeReason" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Link Gambar Meme</label>
                                <input type="text" class="form-control" id="memeImage">
                            </div>

                            <button type="submit" class="btn amado-btn w-100 mt-3">
                                Share Meme
                            </button>

                        </form>

                        <!-- PREVIEW -->
                        <div class="preview-box" id="previewBox">
                            <p><strong>Preview Meme</strong></p>
                            <img id="previewImage">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<footer>
    <p>© <script>document.write(new Date().getFullYear());</script> Meme Archive</p>
</footer>

<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){

    function showAlert(type, message){
        $("#alertBox").html(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
            </div>
        `);
    }

    $("#memeImage").on("keyup", function(){
        let img = $(this).val();
        if(img !== ""){
            $("#previewImage").attr("src", img);
            $("#previewBox").fadeIn();
        } else {
            $("#previewBox").fadeOut();
        }
    });

    $("#shareForm").submit(function(e){
        e.preventDefault();

        if(
            $("#memeTitle").val() === "" ||
            $("#memeCategory").val() === "" ||
            $("#memeOrigin").val() === "" ||
            $("#memeReason").val() === "" ||
            $("#memeImage").val() === ""
        ){
            showAlert("danger", "Semua field wajib diisi.");
        } else {
            showAlert("success", "Meme berhasil disimpan. Mengalihkan ke halaman Meme...");

            setTimeout(function(){
                window.location.href = "shop.html";
            }, 1500);
        }
    });

});
</script>

</body>
</html>
