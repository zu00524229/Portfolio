<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align="center">
        <form name='scor' method='post' action='ex11-03-4.php'>
            <?php
            $dept = $_POST["dept"];   // 系科
            $grade = $_POST["grade"]; //年級
            $class = $_POST["class"]; //班級
            $nu2 = $_POST["nu2"];       //科目數
            $nu = $_POST["nu"];       //接收人數

            for ($y = 1; $y <= $nu2; $y++) {
                $nu2name[] = $_POST["nu2name" . $y];       // 定義科目(欄位)
                $nu3[] = $_POST["nu3" . $y];               // 定義學分(欄位)
            }

            //隱藏表單內容()
            echo "<input type='hidden' name='dept' value='" . $dept . "'>";    //系名稱資料傳送
            echo "<input type='hidden' name='grade' value='" . $grade . "'>";   //年級資料傳送
            echo "<input type='hidden' name='class' value='" . $class . "'>";   //班級資料傳送
            echo "<input type='hidden' name='nu2' value='" . $nu2 . "'>";   //科目資料傳送
            echo "<input type='hidden' name='nu' value='" . $nu . "'>";      //接收人數傳送

            for ($y = 0; $y < $nu2; $y++) {  //科目名資料傳送  //學分資料傳送
                echo "<input type='hidden' name='nu2name" . $y . "'  value='$nu2name[$y]'></td>  
                      <input type='hidden' name='nu3" . $y . "'  value='$nu3[$y]'></td>";
            }


            echo "<h1>中職科技大學</h1>";
            echo "<h4>成績單</h4>";
            echo "系科:" . $dept . "<br>";
            echo "年班:" . $grade . "年" . $class . "班<br>";
            echo "人數:" . $nu . "人<br>";

            echo "請輸入下列資料";

            echo "<table border='2' style='margin:auto;' ><tr><td>座號</td><td>姓名</td>";
            for ($y = 0; $y < $nu2; $y++) {
                echo "<td>" . $nu2name[$y] . "(" . $nu3[$y] . ")</td>";  // 第一列科目(學分)
            }
            echo "</tr>";
            for ($z = 1; $z <= $nu; $z++) {
                echo "<tr><td>$z</td>";             // 人數(幾)列 //科目(幾)科
                for ($a = 0; $a <= $nu2; $a++) {
                    echo "<td><input type='text' name='data" . $z . $a . "' size='4'></td>";    //產生可輸入科目(學分)欄
                }
            }

            echo "</tr>";
            echo "</table>";
            echo "<input type='submit' name='send' value='送出'>";
            echo "<input type='reset' name='reset' value='重填'>";
            ?>
        </form>
    </div>
</body>

</html>