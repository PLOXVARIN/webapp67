<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex 1</title>
</head>
<body>
    <?php
        function test($str){
            $s = substr($str ,strlen($str)-1);
            return $s.$str.$s;       
         }
        echo test("Red")."\n"; 
        echo "<hr>";
        echo test("green")."\n";
        echo "<hr>";
        echo test("1")."\n";
    ?>
</body>
</html>