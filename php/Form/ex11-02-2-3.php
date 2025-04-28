<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align="center">
        <?php
        $dept = $_POST["dept"];   // 系科
        $grade = $_POST["grade"]; //年級
        $class = $_POST["class"]; //班級
        $nu = $_POST["nu"];       //接收人數


        echo "<h1>中職科技大學</h1>";
        echo "<h4>成績單</h4>";
        echo "系科:" . $dept . "<br>";
        echo "年班:" . $grade . "年" . $class . "班<br>";

        echo "　　　　　　　　　　　　　　　　　　　　人數:" . $nu . "人<br>";

        $scodata = array();
        for ($y = 1; $y <= $nu; $y++) {
            for ($x = 0; $x <= 4; $x++) {
                $str = "scodata" . $y . $x;
                $scodata[$y][$x] = $_POST[$str];
            }
        }
        $cradit = array(0, 4, 3, 2, 2); //學分
        for ($y = 1; $y <= $nu; $y++) {
            $scodata[$y][5] = 0;  //總分欄位
            $totalcredit = 0;
            for ($x = 1; $x <= 4; $x++) {
                $scodata[$y][5] = $scodata[$y][5] + $scodata[$y][$x] * $cradit[$x]; //總分
                $totalcredit += $cradit[$x];   //總學分
            }
            $scodata[$y][6] = (int)($scodata[$y][5] / $totalcredit);   //平均
        }

        echo "<table border='1'>";
        echo "<tr><td>座號</td><td>姓名</td><td>國文(4)</td><td>英文(3)</td><td>數學(2)</td><td>化學(2)</td><td>總分</td><td>平均</td></tr>";
        for ($y = 1; $y <= $nu; $y++) {
            echo "<tr><td>" . $y . "</td>";     //座號
            for ($x = 0; $x <= 6; $x++) {
                echo "<td align='center'>" . $scodata[$y][$x] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>

</html>