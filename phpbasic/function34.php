<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function printme($param= NULL){
            print $param;
        }
        
        printme("this is test");
        printme();
        ?>
    
</body>
</html>