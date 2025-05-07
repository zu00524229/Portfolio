<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spacedefense";

// 連線
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// ✅ 檢查是否有收到 POST 值
if (!isset($_POST['name']) || !isset($_POST['score'])) {
    die("缺少 name 或 score 參數");
}

// 接收 POST 參數
$name = $_POST['name'];
$score = $_POST['score'];

$sql = "INSERT INTO scores (name, score) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $name, $score);

if ($stmt->execute()) {
    echo "儲存成功";
} else {
    echo "儲存失敗：" . $stmt->error;
}


$stmt->close();
$conn->close();
