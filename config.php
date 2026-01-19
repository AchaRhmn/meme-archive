<?php
$conn = new mysqli("localhost", "root", "", "meme-archive");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
