<?php
//khai báo session
session_start();
//khai báo utf-8 để hiển thị tiếng việt
header('Content_Type:text/html;charset=UTF-8');

//xử lý đăng nhập $_GET
if(isset($_POST["dangnhap"])){
    //kết nối database
    include('connect.php');

    //lấy dữ liệu nhập vào
    $username = $_POST['username'];
    $password = $_POST['password'];

    //
    $query = "SELECT username,password FROM users WHERE username='$username' and password='$password'";

    $result = mysqli_query($connect,$query);

    if(mysqli_num_rows($result) <= 0){
        echo "ten dang nhap hoac mk khong dung";
    }else{
        echo "dang nhap thanh cong";
        header("location: Search_User.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testttttttttt</title>
</head>
<body>
    <form action="" method="POST">
    username :</br> <input type="text" name = "username" /> </br>
    password :</br> <input type="password" name = "password" /> </br>
    <input type='submit' name="dangnhap" value='Đăng nhập' />
    </form>
</body>
</html>

