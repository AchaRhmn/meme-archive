<?php
session_start();
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

    $stmt = $conn->prepare("SELECT ID_user, pass FROM user WHERE nama = ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($pass, $user["pass"])) {
            // simpan session
            $_SESSION["user_id"] = $user["ID_user"];
            $_SESSION["username"] = $nama;

            echo json_encode([
                "status" => "success",
                "msg" => "Login success"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "msg" => "Wrong password"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "msg" => "User not found"
        ]);
    }
}
?>
