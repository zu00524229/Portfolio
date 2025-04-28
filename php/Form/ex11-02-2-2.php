<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align="center">
        <form name='scor' method='post' action='ex11-02-2-3.php'>
            <?php
            $dept = $_POST["dept"];   // 系科
            $grade = $_POST["grade"]; //年級
            $class = $_POST["class"]; //班級
            $nu = $_POST["nu"];       //接收人數


            echo "<h1>中職科技大學</h1>";
            echo "<h4>成績單</h4>";
            echo "系科:" . $dept . "<br>";
            echo "年班:" . $grade . "年" . $class . "班<br>";

            echo "請輸入下列資料:　　　　　　　　　　　　人數:" . $nu . "人<br>";

            //隱藏表單內容()
            echo "<input type='hidden' name='dept' value='" . $dept . "'>";    //系名稱資料傳送
            echo "<input type='hidden' name='grade' value='" . $grade . "'>";   //年級資料傳送
            echo "<input type='hidden' name='class' value='" . $class . "'>";   //班級資料傳送
            echo "<input type='hidden' name='nu' value='" . $nu . "'>";      //接收人數傳送

            echo "<table border='2'>";
            echo "<tr><td>座號</td><td>姓名</td><td>國文(4)</td><td>英文(3)</td><td>數學(2)</td><td>化學(2)</td></tr>";

            for ($y = 1; $y <= $nu; $y++) {
                echo "<tr><td>" . $y . "</td>";
                for ($x = 0; $x <= 4; $x++) {
                    echo "<td><input type='text' name='scodata" . $y . $x . "' size='8'></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<input type='submit' name='send' value='送出'>";
            ?>
        </form>
    </div>
</body>

</html>