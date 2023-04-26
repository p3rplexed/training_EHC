<?php
$connect = mysqli_connect ('localhost', 'root', '', 'ehc-workshop') or die ('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');

if($connect === false){ 
die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
else {
echo 'Kết nối DB thành công!';
}
?>