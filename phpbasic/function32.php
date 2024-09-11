<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function addfunction($num1,$num2){
            $sum =$num1 + $num2;
            return $sum;
        }
        $return_value = addfunction(10, 20)

        echo "return value from the function : $return_value";
        ?>
    
</body>
</html>