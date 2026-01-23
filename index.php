<?php
session_start();
include "php/config.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.html");
    exit;
}

$memeQuery = mysqli_query($conn, "
    SELECT meme.*, user.nama
    FROM meme
    LEFT JOIN user ON meme.ID_user = user.ID_user
    ORDER BY meme.judul DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meme Archive</title>

<link rel="icon" href="img/core-img/favicon.ico">
<link rel="stylesheet" href="css/core-style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<style>
/* GRID */
.memeasoy-pro-catagory{
  display:grid !important;
  grid-template-columns:repeat(auto-fill,minmax(240px,1fr)) !important;
  gap:20px !important;
  padding:20px !important;
}

/* CARD */
.single-products-catagory{
  width:auto !important;
  height:auto !important;
  position:relative !important;
  overflow:hidden !important;
  border-radius:14px;
  background:#000;
}

/* IMAGE */
.single-products-catagory img{
  width:100% !important;
  height:220px !important;
  object-fit:cover !important;
  cursor:pointer;
}

/* HOVER */
.single-products-catagory .hover-content{
  position:absolute !important;
  bottom:0;
  left:0;
  width:100%;
  padding:15px;
  background:linear-gradient(to top,rgba(0,0,0,.85),transparent);
  color:#fff;
}

/* MODAL */
#memeModal{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.88);
  z-index:99999;
}

.modal-wrapper{
  max-width:900px;
  width:90%;
  margin:60px auto;
  background:#111;
  padding:20px;
  border-radius:16px;
  animation:zoomIn .35s ease;
}

.modal-image{
  width:100%;
  max-height:65vh;
  object-fit:contain;
  border-radius:12px;
  background:#000;
}

.modal-text{
  margin-top:15px;
}

#modalTitle{
  color:#fff;
  font-size:22px;
  margin-bottom:6px;
}

#modalDesc{
  color:#ccc;
  font-size:15px;
  line-height:1.6;
}

.close-modal{
  position:fixed;
  top:25px;
  right:35px;
  font-size:38px;
  color:#fff;
  cursor:pointer;
}

/* ===== FIX CLICK BLOCK ===== */
.single-products-catagory img{
  position:relative;
  z-index:3;
}

.hover-content{
  pointer-events:none;
}

@keyframes zoomIn{
  from{transform:scale(.85);opacity:0}
  to{transform:scale(1);opacity:1}
}

@media(max-width:768px){
  .single-products-catagory img{height:180px !important;}
}
@media(max-width:480px){
  .single-products-catagory img{height:150px !important;}
}
</style>
</head>

<body>

<div class="main-content-wrapper d-flex clearfix">

<header class="header-area clearfix">
  <div class="logo">
    <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
  </div>
  <nav class="memeasoy-nav">
    <ul>
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="share.php">Share Meme</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </nav>
</header>

<div class="products-catagories-area clearfix">
<div class="memeasoy-pro-catagory">


<?php while($meme = mysqli_fetch_assoc($memeQuery)) { ?>
  <div class="single-products-catagory">
    <img
      src="<?= htmlspecialchars($meme['pic']) ?>"
      class="meme-img"
      data-title="<?= htmlspecialchars($meme['judul']) ?>"
      data-desc="<?= htmlspecialchars($meme['desk']) ?>"
      alt="<?= htmlspecialchars($meme['judul']) ?>"
    >
    <div class="hover-content">
      <p>Uploaded by <?= htmlspecialchars($meme['nama']) ?></p>
      <h4><?= htmlspecialchars($meme['judul']) ?></h4>
    </div>
  </div>
<?php } ?>

<div class="single-products-catagory">
        <img src="img/bg-img/1.jpg" alt="">
        <div class="hover-content">
            <p>2013 • Forum Internet</p>
            <h4>Doge Meme</h4>
        </div>
    </div>

    <div class="single-products-catagory">
        <img src="img/bg-img/2.jpg" alt="">
        <div class="hover-content">
            <p>2017 • Twitter</p>
            <h4>Distracted Boyfriend</h4>
        </div>
    </div>

    <div class="single-products-catagory">
        <img src="img/bg-img/3.jpg" alt="">
        <div class="hover-content">
            <p>2019 • TikTok</p>
            <h4>Woman Yelling at Cat</h4>
        </div>
    </div>

    <div class="single-products-catagory">
        <img src="img/bg-img/4.jpg" alt="">
        <div class="hover-content">
            <p>2020 • Reddit</p>
            <h4>Among Us Meme</h4>
        </div>
    </div>

    <div class="single-products-catagory">
        <img src="img/bg-img/5.jpg" alt="">
        <div class="hover-content">
            <p>2021 • Twitter</p>
            <h4>Gigachad</h4>
        </div>
    </div>

    <div class="single-products-catagory">
        <img src="img/bg-img/6.jpg" alt="">
        <div class="hover-content">
            <p>2022 • TikTok</p>
            <h4>NPC Live Meme</h4>
        </div>
    </div>

</div>
</div>
</div>

<!-- ===== MODAL ===== -->
<div id="memeModal">
  <span class="close-modal">&times;</span>
  <div class="modal-wrapper">
    <img id="modalImage" class="modal-image">
    <div class="modal-text">
      <h3 id="modalTitle"></h3>
      <p id="modalDesc"></p>
    </div>
  </div>
</div>

<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script>
$(function(){
    $('.single-products-catagory').on('click', function(){
  let img = $(this).find('.meme-img');
  $('#modalImage').attr('src', img.attr('src'));
  $('#modalTitle').text(img.data('title'));
  $('#modalDesc').text(img.data('desc'));
  $('#memeModal').fadeIn();
});


  $('.close-modal, #memeModal').on('click', function(e){
    if(e.target.id !== 'modalImage'){
      $('#memeModal').fadeOut();
    }
  });

  $(document).keyup(function(e){
    if(e.key === "Escape"){
      $('#memeModal').fadeOut();
    }
  });
});
</script>

</body>
</html>
