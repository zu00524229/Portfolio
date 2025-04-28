<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>財神服務中心</title>
</head>
<style>
    .a {
        font-size: 24px;
        /* 增加字型大小 */

        color: red;
        /* 改變顏色為紅色 */

    }
</style>

<body>
    <?php
    // 檢查是否有表單提交資料
    if (isset($_POST['letro'])) {
        // 接收表單傳來的樂彩種類
        $lottery_type = $_POST['letro'];

        // 根據選擇的樂彩種類顯示結果
        if ($lottery_type == "威力彩") {
            // 生成威力彩號碼
            $ans = letro(6, 38); // 假設 letro 函數會生成隨機號碼
            $ans2 = rand(1, 8); // 第二區隨機產生一個號碼
            echo "威力彩號碼: " . implode(", ", $ans) . " 特別號: " . $ans2;
        } elseif ($lottery_type == "大樂透") {
            // 生成大樂透號碼
            $ans = letro(6, 49); // 假設 letro 函數會生成隨機號碼
            echo "大樂透號碼: " . implode(", ", $ans);
        } elseif ($lottery_type == "金彩539") {
            // 生成金彩539號碼
            $ans = letro(5, 39); // 生成 5 個號碼，範圍是 1-39
            echo "金彩539號碼: " . implode(", ", $ans);
        }
    } else {
        echo "請選擇樂彩種類";
    }

    // letro 函數範例
    function letro($maxball, $totalball)
    {
        $lertonum1 = array();
        // 初始劃一格從1到x的數字序列
        for ($a = 1; $a <= $totalball; $a++) {
            $lertonum1[$a] = $a;  // 填充序列
        }
        $ans = array();
        //進行隨機選擇,生成$y個數字
        for ($a = $totalball; $a > ($totalball - $maxball); $a--) {
            $k = rand(1, $a);  // 隨機生成1到$a之間的數字
            $ans[] = $lertonum1[$k];  // 將隨機選重的數字加入陣列
            $lertonum1[$k] = $lertonum1[$a];  // 用最後一個數字替換選重的數字
        }
        // 排序並返回隨機選擇的數字
        sort($ans);
        return $ans;
    }
    ?>

</body>

</html>