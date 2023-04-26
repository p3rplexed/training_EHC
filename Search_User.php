<?php
session_start();

echo "Bạn đã đăng nhập thành công!!!<br />";

require_once "connect.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            background-image:url("https://thienluc.vn/hinh-nen-web-dep/imager_4_42037_700.jpg");
        }
    </style>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <input type="text" name="search" id="search_input" value="<?php if (isset($_GET["search"])) {
                                                            echo $_GET["search"];
                                                        } ?>" class="form-control" placeholder="Tên người dùng"> <br>
                <button type="submit" name="commit" class="btn btn-primary center-block">Search</button>
            </div>
        </div>
    </form>

    <br><br><br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">username</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                if (isset($_GET["search"]) && !empty($_GET["search"])) {
                    $value = $_GET["search"];
    
                    // code fix
                    // 1
                    // $sanitized_username = mysqli_real_escape_string($connect, $value);               
                    // $sql = "SELECT id,username FROM user WHERE username LIKE '%$sanitized_username%'";
                    $regex = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value);
                    if ($value) { 
                        $sql = "SELECT id,username FROM users WHERE username LIKE '%$value%'";
                        $result = mysqli_query($connect, $sql);
    /*                     $sql = 'SELECT id,username FROM user  WHERE username = ?';
                        // use prepared statement to prevent SQL injection
                        $preparedStatement = $connect->prepare($sql);
                        $preparedStatement->bind_param('s', $value); 
                        $preparedStatement->execute();
                        $result = $preparedStatement->get_result();
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';   
                                    echo "<td></br>{$row["id"]}</td>";                 
                                    echo "<td></br>{$row["username"]}</td>";                                    
                                echo '</tr>';
        
                            }
                        }
                        else{
                            ?>
                            <tr>
                                <td colspan="3">Not found</td>
                            </tr>
                            <?php
                        } */
                        
    
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $items) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $items["id"]; ?></th>
                                        <td><?= $items["username"]; ?></td>
                                    </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3">Not found</td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        http_response_code(400);
                        die('Error processing bad or malformed request');
                    }
                }    
            } catch (\Throwable $th) {
            }

            ?>
        </tbody>
    </table>
    <!-- 
    <p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </p> -->
</body>

</html>

