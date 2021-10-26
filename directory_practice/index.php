<?php
$handle = fopen("scott.txt", "w");
fwrite($handle, "Hello class");
fclose($handle);

$handle = fopen("scott.txt", "r");
echo fread($handle, 1000);
fclose($handle);

?>
