<?php
for ($x = 1; $x <= 4; $x++)                      //接收陣列資料
{
    for ($y = 1; $y <= 4; $y++) {
        $trname = "a" . $x . $y;
        $a[$x][$y] = $_POST[$trname];
    }
}

$tran = $_POST["tran"];         //接收移動方向資料

//設定 $b(4*4陣列)
for ($x = 1; $x <= 4; $x++) {
    for ($y = 1; $y <= 4; $y++) {
        $b[$x][$y] = 0;
    }
}

//資料依指定方向移動
if ($tran == "往上") {
    for ($y = 1; $y <= 4; $y++)                  //判斷若上方為空格，則資料往上移
    {
        $ty = 1;
        for ($x = 1; $x <= 4; $x++) {
            if ($a[$x][$y] != 0) {
                $b[$ty][$y] = $a[$x][$y];
                $ty++;
            }
        }
    }
    for ($y = 1; $y <= 4; $y++)                  //判斷若上下兩格資料相同,則資料相加,其後資料往上移
    {
        if (($b[1][$y] == $b[2][$y]) and ($b[1][$y] != 0)) {
            $b[1][$y] *= 2;
            $b[2][$y] = $b[3][$y];
            $b[3][$y] = $b[4][$y];
            $b[4][$y] = 0;
        }
        if (($b[2][$y] == $b[3][$y]) and ($b[2][$y] != 0)) {
            $b[2][$y] *= 2;
            $b[3][$y] = $b[4][$y];
            $b[4][$y] = 0;
        }
        if (($b[3][$y] == $b[4][$y]) and ($b[3][$y] != 0)) {
            $b[3][$y] *= 2;
            $b[4][$y] = 0;
        }
    }
} elseif ($tran == "往下") {
    for ($y = 1; $y <= 4; $y++)                  //判斷若下方為空格，則資料往下移
    {
        $ty = 4;
        for ($x = 4; $x >= 1; $x--) {
            if ($a[$x][$y] != 0) {
                $b[$ty][$y] = $a[$x][$y];
                $ty--;
            }
        }
    }
    for ($y = 1; $y <= 4; $y++)                  //判斷若上下兩格資料相同,則資料相加,其後資料往下移
    {
        if (($b[4][$y] == $b[3][$y]) and ($b[4][$y] != 0)) {
            $b[4][$y] *= 2;
            $b[3][$y] = $b[2][$y];
            $b[2][$y] = $b[1][$y];
            $b[1][$y] = 0;
        }
        if (($b[3][$y] == $b[2][$y]) and ($b[3][$y] != 0)) {
            $b[3][$y] *= 2;
            $b[2][$y] = $b[1][$y];
            $b[1][$y] = 0;
        }
        if (($b[2][$y] == $b[1][$y]) and ($b[2][$y] != 0)) {
            $b[2][$y] *= 2;
            $b[1][$y] = 0;
        }
    }
} elseif ($tran == "往左") {
    for ($x = 1; $x <= 4; $x++)                  //判斷若左方為空格，則資料往左移
    {
        $ty = 1;
        for ($y = 1; $y <= 4; $y++) {
            if ($a[$x][$y] != 0) {
                $b[$x][$ty] = $a[$x][$y];
                $ty++;
            }
        }
    }
    for ($x = 1; $x <= 4; $x++)                  //判斷若相鄰兩格資料相同,則資料相加,其後資料往左移
    {
        if (($b[$x][1] == $b[$x][2]) and ($b[$x][1] != 0)) {
            $b[$x][1] *= 2;
            $b[$x][2] = $b[$x][3];
            $b[$x][3] = $b[$x][4];
            $b[$x][4] = 0;
        }
        if (($b[$x][2] == $b[$x][3]) and ($b[$x][2] != 0)) {
            $b[$x][2] *= 2;
            $b[$x][3] = $b[$x][4];
            $b[$x][4] = 0;
        }
        if (($b[$x][3] == $b[$x][4]) and ($b[$x][3] != 0)) {
            $b[$x][3] *= 2;
            $b[$x][4] = 0;
        }
    }
} else    //往右
{
    for ($x = 1; $x <= 4; $x++)                  //判斷若右方為空格，則資料往右移
    {
        $ty = 4;
        for ($y = 4; $y >= 1; $y--) {
            if ($a[$x][$y] != 0) {
                $b[$x][$ty] = $a[$x][$y];
                $ty--;
            }
        }
    }
    for ($x = 1; $x <= 4; $x++)                  //判斷若相鄰兩格資料相同,則資料相加,其後資料往右移
    {
        if (($b[$x][4] == $b[$x][3]) and ($b[$x][4] != 0)) {
            $b[$x][4] *= 2;
            $b[$x][3] = $b[$x][2];
            $b[$x][2] = $b[$x][1];
            $b[$x][1] = 0;
        }
        if (($b[$x][3] == $b[$x][2]) and ($b[$x][3] != 0)) {
            $b[$x][3] *= 2;
            $b[$x][2] = $b[$x][1];
            $b[$x][1] = 0;
        }
        if (($b[$x][2] == $b[$x][1]) and ($b[$x][2] != 0)) {
            $b[$x][2] *= 2;
            $b[$x][1] = 0;
        }
    }
}

//設定新數字陣列 長度 35
for ($i = 1; $i <= 30; $i++) {
    $newnu[$i] = 2;
}
$newnu[] = 4;
$newnu[] = 4;
$newnu[] = 4;
$newnu[] = 4;
$newnu[] = 8;

//統計空值陣列
//    陣列位置值分別為    1   2   3   4
//                        5   6   7   8
//                        9  10  11  12
//                       13  14  15  16
//  所以 位置值對應陣列索引座標為  ($x-1)*4+$y
//
// 統計空格位置陣列
$emptyarr = array();
for ($x = 1; $x <= 4; $x++) {
    for ($y = 1; $y <= 4; $y++) {
        if ($b[$x][$y] == 0) {
            $k = ($x - 1) * 4 + $y;
            $emptyarr[] = $k;  // 儲存空格位置
        }
    }
}

// 設定遊戲結束訊息
$endnotice = "遊戲結束";

// 檢查是否還有空格
if (count($emptyarr) != 0) {
    // 生成新數字
    $newnumber = $newnu[rand(1, 35)];

    // 隨機選擇空格位置
    $k = rand(0, count($emptyarr) - 1);  // 隨機抽取一個空格位置

    // 計算空格的 $x 和 $y 索引值
    $y = ($emptyarr[$k] % 4);  // 取得 $y 索引
    if ($y == 0) {
        $y = 4;
    }
    $x = (int)(($emptyarr[$k] - $y) / 4) + 1;  // 計算 $x 索引

    // 在隨機位置放置新數字
    $b[$x][$y] = $newnumber;
    $endnotice = "";  // 如果有空格，遊戲繼續
} else {
    // 如果沒有空格，檢查是否有相同的鄰格數字可以合併
    $tsc = 0;  // 預設為無相同數字
    for ($x = 1; $x <= 4; $x++) {
        for ($y = 1; $y < 4; $y++) {
            if ($b[$x][$y] == $b[$x][$y + 1]) {
                $tsc = 1;  // 如果有相同數字
            }
        }
    }
    for ($x = 1; $x <= 4; $x++) {
        for ($y = 1; $y < 4; $y++) {
            if ($b[$y][$x] == $b[$y + 1][$x]) {
                $tsc = 1;  // 如果有相同數字
            }
        }
    }

    // 若有相同數字則顯示提示
    if ($tsc == 1) {
        $endnotice = "<font color='red'>請嘗試其他方向按鈕</font>";
    }
}

echo $endnotice;

//列印2048初始畫面

echo "<body bgcolor='#FAEBD7'>";  // 背景色可以選擇淡米色
echo "<center><h1>2048遊戲</h1>";
echo "<table border='5' style='border-color: #666666;'>";
for ($x = 1; $x <= 4; $x++) {
    echo "<tr>";
    for ($y = 1; $y <= 4; $y++) {
        if ($b[$x][$y] == 0) {
            echo "<td bgcolor='#D3D3D3' width='110' height='110' align='center' valign='middle'></td>";
        } elseif ($b[$x][$y] == 2) {
            echo "<td bgcolor='#EEE4DA' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 4) {
            echo "<td bgcolor='##EDE0C8' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 8) {
            echo "<td bgcolor='#F2B179' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 16) {
            echo "<td bgcolor='#F59563' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 32) {
            echo "<td bgcolor='#F67C5F' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 64) {
            echo "<td bgcolor='#F65E3B' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 128) {
            echo "<td bgcolor='#EDCF72' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 256) {
            echo "<td bgcolor='#EDCC61' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 512) {
            echo "<td bgcolor='#EDC850' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 1024) {
            echo "<td bgcolor='#EDC53F' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 2048) {
            echo "<td bgcolor='#EDC22E' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</td>";
        } elseif ($b[$x][$y] == 4096) {
            echo "<td bgcolor='#3C3A32' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 8192) {
            echo "<td bgcolor='#FF8C00' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } elseif ($b[$x][$y] == 16384) {
            echo "<td bgcolor='#FF4500' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</font></td>";
        } else {
            echo "<td bgcolor='#FF00CC' width='110' height='110' align='center' valign='middle'><font size='7'>" . $b[$x][$y] . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";

//傳送表單設定
if ($endnotice == "遊戲結束") {
    echo "<br><br><form method='post' action='ex2048-01.php'>";
    echo $endnotice . "<br>";
    echo "<input type='submit' name='tran' value='繼續下一局'>　　";
    echo "</form></center>";
} else {
    echo "<br><br><form method='post' action='ex2048-02.php'>";
    for ($x = 1; $x <= 4; $x++) {
        for ($y = 1; $y <= 4; $y++) {
            echo "<input type='hidden' name='a" . $x . $y . "' value='" . $b[$x][$y] . "'>";
        }
    }
    echo "<input type='submit' name='tran' value='往上'>　　";
    echo "<input type='submit' name='tran' value='往下'>　　";

    echo "<input type='submit' name='tran' value='往左'>　　";
    echo "<input type='submit' name='tran' value='往右'>　　";
    echo "</form></center>";
}
