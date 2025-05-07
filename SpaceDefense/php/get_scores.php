<?php
$servername = "localhost";
$username = "root";
$password = "";         // 預設 XAMPP 沒有密碼
$dbname = "spacedefense";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// 查詢最新的前10名分數
$sql = "SELECT name, score FROM scores ORDER BY score DESC LIMIT 10";
$result = $conn->query($sql);

$scores = array();
while ($row = $result->fetch_assoc()) {
    $scores[] = $row;
}

// 回傳 JSON 格式
echo json_encode($scores);
$conn->close();
