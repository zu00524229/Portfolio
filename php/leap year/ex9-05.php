<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>成績計算</title>
</head>

<body>
   <h1>成績計算</h1>
    <?php        
        $class=$_POST["class"];
        $seno=$_POST["seno"];
        $nam=$_POST["nam"];
        $ch=$_POST["ch"];
        $en=$_POST["en"];
        $ma=$_POST["ma"];
        $ph=$_POST["ph"];


        $total=$ch+$en+$ma+$ph;
        $avg=$total/4;
        
        // 國文
        if ($ch >= 60) {
            if($ch >= 70){
                if($ch >= 80){
                    if($ch >= 90){
                        $chGrade = "優等";
                    }else{
                        $chGrade = "甲等";
                    }
                }else{
                    $chGrade = "乙等";
                }
            }else{
               $chGrade = "丙等";
            }
        }else{
            $chGrade = "丁等";           
        }
        // 英文
        if ($en >= 60) {
            if($en >= 70){
                if($en >= 80){
                    if($en >= 90){
                        $enGrade = "優等";
                    }else{
                        $enGrade = "甲等";
                    }
                }else{
                    $enGrade = "乙等";
                }
            }else{
                $enGrade = "丙等";
            }
        }else{
            $enGrade = "丁等";           
        }
        // 數學
        if ($ma >= 60) {
            if($ma >= 70){
                if($ma >= 80){
                    if($ma >= 90){
                        $maGrade = "優等";
                    }else{
                        $maGrade = "甲等";
                    }
                }else{
                    $maGrade = "乙等";
                }
            }else{
                $maGrade = "丙等";
            }
        }else{
            $maGrade = "丁等";           
        }
        // 物理
        if ($ph >= 60) {                                            
            if($ph >= 70){
                if($ph >= 80){
                    if($ph >= 90){
                        $phGrade = "優等";
                    }else{
                        $phGrade = "甲等";
                    }
                }else{
                    $phGrade = "乙等";
                }
            }else{
                $phGrade = "丙等";
            }
        }else{
            $phGrade = "丁等";           
        }
          
        echo "<table>";
        echo "<tr><th colspan='3'><font size='5'>成績單</font></th></tr>";                
        echo "<tr><td colspan='3'>班級：".$class."　　　座號：".$seno."</td></tr>";
        echo "<tr><td colspan='3'>姓名：".$nam."</td></tr>";
        echo "<tr><td>國文：".$ch."　　　".$chGrade."</td></tr>";
        echo "<tr><td>英文：".$en."　　　".$enGrade."</td></tr>";
        echo "<tr><td>數學：".$ma."　　　".$maGrade."</td></tr>";
        echo "<tr><td>物理：".$ph."　　　".$phGrade."</td></tr>";
        echo "<tr ><td class='border-top' colspan='3'>總分：".$total."　　　平均：".$avg."</td></tr>";
        echo "</table>";
        ?>
        <a href="ex9-02-2.html">繼續下一筆</a>
</body>
</html>