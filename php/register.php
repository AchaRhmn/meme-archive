<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama  = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $pass  = trim($_POST["pass"]);

    if ($nama === "" || $email === "" || $pass === "") {
        echo json_encode([
            "status" => "error",
            "msg" => "Semua field wajib diisi"
        ]);
        exit;
    }

    // cek email sudah terdaftar
    $check = $conn->prepare("SELECT ID_user FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "msg" => "Email sudah terdaftar"
        ]);
        exit;
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO user (nama, email, pass) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $nama, $email, $hash);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "msg" => "Registrasi berhasil"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "msg" => "Registrasi gagal"
        ]);
    }
}
?>
