<?php
session_start();
include "php/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT nama, email FROM user WHERE ID_user='$id'");
$user  = mysqli_fetch_assoc($query);

$countQ = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM meme 
    WHERE ID_user='$id'
");
$count = mysqli_fetch_assoc($countQ);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Meme Archive | User Profile</title>

    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

    <style>
        /* ===== GLOBAL ===== */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #111;
        }

        .main-content-wrapper {
            flex: 1;
            background: #b8b8b8;
        }

        .cart-table-area {
            background: #b8b8b8;
        }

        /* ===== PROFILE CARD ===== */
        .profile-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 40px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }

        .profile-card img {
            width: 120px;
            border-radius: 50%;
            border: 3px solid #fbb710;
        }

        .profile-card h4 {
            color: #222;
            font-weight: 600;
        }

        .profile-card p {
            color: #555;
            font-size: 15px;
        }

        .profile-card strong {
            color: #333;
        }

        .profile-card .text-muted {
            color: #777 !important;
        }

        /* ===== FORM ===== */
        .profile-card input.form-control {
            background: #f7f7f7;
            border: 1px solid #ddd;
            color: #333;
        }

        .profile-card input.form-control:focus {
            background: #fff;
            border-color: #fbb710;
            box-shadow: none;
        }

        /* ===== FOOTER ===== */
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

<!-- ##### MAIN CONTENT ##### -->
<div class="main-content-wrapper d-flex clearfix">

    <!-- MOBILE NAV -->
    <div class="mobile-nav">
        <div class="memeasoy-navbar-brand">
            <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
        </div>
        <div class="memeasoy-navbar-toggler">
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

   <nav class="memeasoy-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="share.php">Share meme</a></li>
                    <li class="active"><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
    </header>

    <!-- PROFILE CONTENT -->
    <div class="cart-table-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="profile-card text-center">
                        <img src="img/profile/35c58704d8812a9cd32e2ce30121ed6e.jpg" alt="User">
                        <h4 class="mt-3"><?= htmlspecialchars($user['nama']) ?></h4>
                        <p class="text-muted">Member Meme Archive</p>

                        <!-- ALERT -->
                        <div id="alertBox" class="mt-3"></div>

                        <!-- INFO -->
                        <div id="profileInfo">
                            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                            <p><strong>Total Meme Dibagikan:</strong><?= $count['total'] ?? 0 ?></p>
                            <button class="btn memeasoy-btn mt-2" id="editProfileBtn">
                                Edit Profile
                            </button>
                        </div>

                        <!-- EDIT FORM -->
                        <div id="editProfileForm" style="display:none;">
                            <form id="formProfile" class="mt-4 text-left">
                                <input type="text" class="form-control mb-3"
                                    id="profileName"
                                    value="<?= htmlspecialchars($user['nama']) ?>">

                                <input type="email" class="form-control mb-3"
                                    id="profileEmail"
                                    value="<?= htmlspecialchars($user['email']) ?>">

                                <button type="submit" class="btn memeasoy-btn w-100">
                                    Save Changes
                                </button>
                            </form>
                            <button class="btn btn-outline-secondary mt-3" id="cancelEdit">
                                Cancel
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- FOOTER -->
<footer>
    <p>
        © <script>document.write(new Date().getFullYear());</script> Meme Archive
    </p>
</footer>

<!-- JS -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){

    function showAlert(type, message){
        $("#alertBox").html(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        `);
    }

    $("#editProfileBtn").click(function(){
        $("#profileInfo").slideUp();
        $("#editProfileForm").slideDown();
    });

    $("#cancelEdit").click(function(){
        $("#editProfileForm").slideUp();
        $("#profileInfo").slideDown();
        $("#alertBox").html("");
    });

    $("#formProfile").submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "php/update_profile.php",
        type: "POST",
        dataType: "json",
        data: {
            nama: $("#profileName").val(),
            email: $("#profileEmail").val()
        },
        success: function(res){
            showAlert(
                res.status === "success" ? "success" : "danger",
                res.msg
            );

            if(res.status === "success"){
                setTimeout(() => location.reload(), 800);
            }
        }
    });
});


});
</script>

</body>
</html>
