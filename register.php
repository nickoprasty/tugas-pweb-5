<?php 
    include "service/database.php";
    session_start();
    $register_message = "";

    if(isset($_SESSION["is_login"])){
        header("location: dashboard.php");
        
    }
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);
        try{
            $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hash_password')";

            if($db->query($sql)){
                $register_message = "akun berhasil dibuat, silahkan login";
                
            }else{
                $register_message = "gagal membaut akun, coba lagi!";
            }   
        }catch(mysqli_sql_exception){
            $register_message = "username sudah digunakan";
        }
        $db->close();
        
        
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "layout/header.html"?>
    <h1>DAFTAR AKUN</h1>
    <i><?= $register_message ?></i>
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="username" id="">
        <input type="password" name="password" placeholder=""password id="">
        <br>
        <button type="submit" name="register">Daftar</button>
    </form>
    <?php include "layout/footer.html"?>
</body>
</html>