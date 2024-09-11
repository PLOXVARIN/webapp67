<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex 4</title>
</head>
<body>
    <?php
        function test($s){
            $ctr_aa =0;
            $i =0;

            while($i < (strlen($s) -1)){
                if(substr($s, $i,2)== "aa"){
                    $ctr_aa++;
                    $i++;
                }else{
                    $i++;
                }    
            }    
                return $ctr_aa;
        }    
        echo test("bbaaccaag")."\n";
        echo "<hr>";
        echo test("jjkiaasew")."\n";
        echo "<hr>";
        echo test("JSaakoiaa")."\n";
    ?>
    
    
</body>
</html>