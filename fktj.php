<?php
$n=file_get_contents('fktj.txt');
$n++;
file_put_contents('fktj.txt',$n);
echo "document.write($n);";
?>
