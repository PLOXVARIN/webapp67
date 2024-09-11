<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function sayhello(){
            echo"this is PHP";
            echo "<br>";
            echo "hello";
        }
        
        $function_holder = "sayhello";
        $function_holder();
        ?>
    
</body>
</html>