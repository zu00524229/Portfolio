<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Score Sheet</title>
</head>

<body>
    <div align="center">
        <form name='scor' method='post' action='ex11-03-4.php'>
            <?php
            // 接收基本資料
            $dept = $_POST["dept"];
            $grade = $_POST["grade"];
            $class = $_POST["class"];
            $nu2 = $_POST["nu2"];
            $nu = $_POST["nu"];

            // 初始化學分總數與相關陣列
            $totalnu3 = 0;
            $nu2name = [];
            $nu3 = [];

            // 收集科目名稱與學分
            for ($y = 0; $y < $nu2; $y++) {
                $nu2name[] = $_POST["nu2name" . $y];
                $nu3[] = $_POST["nu3" . $y];
                $totalnu3 += $nu3[$y];
            }

            // 收集學生資料
            $data = [];
            for ($z = 1; $z <= $nu; $z++) {
                for ($x = 0; $x <= $nu2 + 1; $x++) { // 索引包含姓名與成績
                    $data[$z][$x] = $_POST["data" . $z . $x] ?? ""; // 預防未定義索引
                }
            }

            // 計算每位學生的總分與平均
            $totals = [];
            $averages = [];

            for ($z = 1; $z <= $nu; $z++) {
                $totals[$z] = 0;
                $totCredits = 0; // 加權學分總和

                for ($x = 1; $x <= $nu2; $x++) {
                    $score = (int)$data[$z][$x + 1]; // 確保為整數，索引偏移+1是跳過姓名欄位
                    $credit = $nu3[$x - 1]; // 對應科目學分數
                    $totals[$z] += $score * $credit; // 加權分數總和
                    $totCredits += $credit; // 累加學分
                }

                // 計算平均：總分 / 總學分
                $averages[$z] = $totals[$z] / $totCredits;
            }


            // 計算名次
            $ranking = $totals; //學生總分
            arsort($ranking);   // 根據學生總分進行降序(arsort)
            $ranks = [];
            $rank = 1;
            foreach ($ranking as $key => $value) {
                $ranks[$key] = $rank++; //將名次分配給學生
            }

            // 顯示基本資料
            echo "<h1>中職科技大學</h1>";
            echo "<h4>成績單</h4>";
            echo "系科:" . ($dept) . "<br>";
            echo "年班:" . ($grade) . "年" . ($class) . "班<br>";
            echo "人數:" . $nu . "人<br>";
            echo "<table border='2' style='margin:auto;' ><tr><td>座號</td><td>姓名</td>";

            // 顯示科目名稱與學分
            for ($y = 0; $y < $nu2; $y++) {
                echo "<td>" . ($nu2name[$y]) . "(" . ($nu3[$y]) . ")</td>";
            }
            echo "<td>總分</td><td>平均</td><td>名次</td><td>實得學分</td></tr>";

            // 顯示每位學生的資料
            for ($z = 1; $z <= $nu; $z++) {
                echo "<tr><td>$z</td>";
                echo "<td>" . ($data[$z][0]) . "</td>"; // 顯示姓名

                $earnedCredits = 0; // 計算實得學分

                for ($x = 1; $x <= $nu2; $x++) {
                    $score = (int)$data[$z][$x];
                    $isFailing = $score < 60;

                    // 不及格以紅字顯示
                    if ($isFailing) {
                        echo "<td style='color:red;'>$score</td>";
                    } else {
                        echo "<td>$score</td>";
                        $earnedCredits += $nu3[$x - 1]; // 累加學分
                    }
                }

                echo "<td>" . $totals[$z] . "</td>"; // 總分
                echo "<td>" . number_format($averages[$z], 2) . "</td>"; // 平均
                echo "<td>" . $ranks[$z] . "</td>"; // 名次
                echo "<td>" . $earnedCredits . "</td>"; // 實得學分
                echo "</tr>";
            }

            echo "</table>";
            ?>
        </form>
    </div>
</body>

</html>