<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = trim($_POST["nama"]);
    $pass = trim($_POST["pass"]);

    if (empty($nama) || empty($pass)) {
        echo json_encode([
            "status" => "error",
            "msg" => "All fields required"
        ]);
        exit;
    }

    // cek username sudah ada atau belum
    $check = $conn->prepare("SELECT ID_user FROM user WHERE nama = ?");
    $check->bind_param("s", $nama);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "msg" => "Username already taken"
        ]);
        exit;
    }

    // hash password
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // insert user baru
    $stmt = $conn->prepare("INSERT INTO user (nama, pass) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $hash);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "msg" => "Register success"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "msg" => "Register failed"
        ]);
    }
}
?>
