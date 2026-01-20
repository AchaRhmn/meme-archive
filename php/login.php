<?php
session_start();
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $pass  = trim($_POST["pass"]);

    if ($email === "" || $pass === "") {
        echo json_encode([
            "status" => "error",
            "msg" => "Email dan password wajib diisi"
        ]);
        exit;
    }

    $stmt = $conn->prepare(
        "SELECT ID_user, nama, pass FROM user WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            "status" => "error",
            "msg" => "Email tidak terdaftar"
        ]);
        exit;
    }

    $user = $result->fetch_assoc();

    if (!password_verify($pass, $user["pass"])) {
        echo json_encode([
            "status" => "error",
            "msg" => "Password salah"
        ]);
        exit;
    }

    // SIMPAN SESSION
    $_SESSION["user_id"] = $user["ID_user"];
    $_SESSION["user_name"] = $user["nama"];
    $_SESSION["user_email"] = $email;

    echo json_encode([
        "status" => "success",
        "msg" => "Login berhasil"
    ]);
}
