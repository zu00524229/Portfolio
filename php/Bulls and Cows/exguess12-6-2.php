<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>猜數字遊戲</title>
</head>

<body>
    <?php
    $strtime = time(); //開始時間

    // 產生一組4位不重覆數字
    $p = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    for ($a = 9; $a > 5; $a--) {
        $k = rand(0, $a);       // $k=0~9之間取1數
        $ti[9 - $a] = $p[$k]; //$ti為題目數字
        $p[$k] = $p[$a];     // 假設取值為4，$p[4]=$p[9],原先[4]的位置就變成索引[9]值的數(0,1,2,3,9,5,6,7,8,9)
    }
    //////////////////////   資料加密   //////////////////////////////
    ///////////  1.資料倒置

    for ($a = 0; $a < 4; $a++) {
        $ti[$a] = 9 - $ti[$a];
    }
    //////////    2.往左移一位

    $k = $ti[0];
    $ti[0] = $ti[1];
    $ti[1] = $ti[2];
    $ti[2] = $ti[3];
    $ti[3] = $k;
    /////////////////////////////// 連結成字串  //////////////////////

    $tp = $ti[0] . $ti[1] . $ti[2] . $ti[3]; //列印所產生的數字

    $infotime = localtime($strtime, true);
    echo "猜答開始時間:" . ($infotime["tm_year"] + 1900) . "年" . ($infotime["tm_mon"] + 1) .
        "月" . $infotime["tm_mday"] . "日" . ($infotime["tm_hour"] + 7) . "點" . $infotime["tm_min"] . "分" . $infotime["tm_sec"] . "秒<br>";

    // 遊戲顯示
    echo "<h1>猜數字遊戲</h1>";
    echo "<form method='post' action='exguess12-6-3.php'>";
    echo "題目數字:<input type='password' name='tan' value='" . $tp . "' size='4'>　　　結果<br>";
    echo "<input type='hidden' name='tp' value='" . $tp . "' size='4'><br>";
    echo "<input type='hidden' name='coti' value='' size='4'><br>";
    echo "第1次猜:<input type='text' name='ans' value='1' size='4'><br>";
    echo "<input type='submit' name='submit' value='送出'>";

    echo "<input type='hidden' name='strtime' value='" . $strtime . "'><br>";  // 遊戲開始時間


    echo "</form>";



    ?>
</body>

</html>