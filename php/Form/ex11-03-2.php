<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align="center">
        <form name='scor' method='post' action='ex11-03-3.php'>
            <?php
            $dept = $_POST["dept"];   // 系科
            $grade = $_POST["grade"]; //年級
            $class = $_POST["class"]; //班級
            $nu2 = $_POST["nu2"];       //科目數
            $nu = $_POST["nu"];       //接收人數



            echo "<h1>中職科技大學</h1>";
            echo "<h4>成績單</h4>";
            echo "系科:" . $dept . "<br>";
            echo "年班:" . $grade . "年" . $class . "班<br>";
            echo "科目數:" . $nu2 . "<br>";

            echo "請輸入下列資料<br>";

            echo "請輸入個科目名稱及學分:";

            //隱藏表單內容()
            echo "<input type='hidden' name='dept' value='" . $dept . "'>";    //系名稱資料傳送
            echo "<input type='hidden' name='grade' value='" . $grade . "'>";   //年級資料傳送
            echo "<input type='hidden' name='class' value='" . $class . "'>";   //班級資料傳送
            echo "<input type='hidden' name='nu2' value='" . $nu2 . "'>";   //科目資料傳送
            echo "<input type='hidden' name='nu' value='" . $nu . "'>";      //接收人數傳送

            echo "<table border='2'>";
            echo "<tr><td>科目編號</td><td>科目名稱</td><td>學分</td></tr>";

            for ($y = 1; $y <= $nu2; $y++) {
                echo "<tr><td>$y</td>
                <td><input type='text' size='5' name='nu2name" . $y . "'></td>          
                <td><input type='text' size='5' name='nu3" . $y . "'></td></tr>";
            }
            echo "</table>";
            echo "<input type='submit' name='send' value='送出'>";
            ?>
        </form>
    </div>
</body>

</html>