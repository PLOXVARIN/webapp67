<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP variable via referant</title>
</head>
<body>
    <?php
        function addfive($num){
            $num += 5;
        }
        
        function six(&$num){
            $num += 6;
        }
        &orignum = 10;
        addfive($orignum);
        echo "Original valuenis $orignum";
        echo "br";

        addsix($orignum);
        echo "Original valuenis $orignum";
        echo "br";
    ?>
</body>
</html>