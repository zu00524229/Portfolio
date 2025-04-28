<!--
    .不可被4整除者為平年。

  .可被4整除且不為100整除者為閏年。

  .可被400整除為閏年。

  .可被1000整除為閏年  

  2.閏年一年366天，平年一年365天

  .從西元 1年到 輸入的前一年份中，共有多少個閏年
例:輸入2020
判斷2020是否為閏年
計算從1~2019年中共有多少閏年
3.(已知西元元年元旦為星期一)，請計算出所輸入年份(例:2020)的元旦是星期?
-->


<?php
    $year=$_POST["year"];

    if(($year%4 == 0 && $year%100 != 0) || $year%400 == 0){
        $yeard = "閏年!!";
    }else{
        $yeard ="平年";
    }

    $leapyear = 0;
    for($i=1; $i< $year; $i++){
        if(($i%4 == 0 && $i%100 != 0) || $i%400 ==0){
            $leapyear++;
        }
    }

    $day = 0;
    for($i=1; $i<$year; $i++){
        if(($i%4 == 0 && $i%100 != 0) || $i%400 == 0){
            $day +=366;
        }else{
            $day +=365;
        }
    }
    $dayOfweek = ($day % 7 +1) % 7;
    $weekdays=["日","一","二","三","四","五","六"];
    $weekday = $weekdays[$dayOfweek];

    echo "<h3 style='font-size: 50px;'>閏年判斷</h3>";
    echo "此西元年為：<span style='color: red; font-size: 30px;'>{$yeard}</span><br>";
    echo "1~".($year-1)."間共有幾個閏年:<span style='color: red; font-size: 30px;'>$leapyear</span><br>";
    echo "$year 年元旦是星期幾：星期　<span style='color: red; font-size: 30px;'>$weekday</span><br>";

    ?>