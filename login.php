<?php

include_once("connections/connections.php");
$con = connection();
session_start();


if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM tbl_student_users where username = '$username' && password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total > 0)
    {
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['role'];

        echo header("Location: index.php");
    }  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="css/style.css">   
</head>
<body id="formlogin">
    <div class="login-container">
        <h2>Student Information System</h2>

        <div class="form-logo">
            <img src="img/login.png" alt="">
        </div>

        <form action="" method="post">

            <div class="form-element">
                <label>Login your account</label>
                
                <?php if(isset($_POST['login']) && $total <= 0){ ?> 
                <?php echo "<div class='message warning'>Incorrect Username or Password</div>"; ?>
                <?php } ?>
                
                <input type="text" name="username" id="username" placeholder="Enter username" required>             
                <input type="password" name="password" id="password" placeholder="Enter password" required>  
            </div>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>