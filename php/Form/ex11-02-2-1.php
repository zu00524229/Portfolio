<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>成績系統</h1>
    <h3>單科</h3>
    <label>請輸入下列項目</label>
    <br>
    <form method="POST" action="ex11-02-2-2.php">
        系科:<select name="dept">
            <option value="幼兒">幼兒</option>
            <option value="機械">機械</option>
            <option value="程式" selected>程式</option>
        </select><br>
        <select name="grade">
            <option value="一">一</option>
            <option value="二">二</option>
            <option value="三">三</option>
        </select>年:
        <select name="class">
            <option value="甲">甲</option>
            <option value="乙">乙</option>
            <option value="丙">丙</option>
        </select>班
        <br>人　數:
        <input type='text' name='nu'><br>
        <input type='submit' name='sebmit' value='送出'>
        <input type='reset' name='reset' value='重填'>
    </form>
</body>

</html>