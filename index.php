<?php

if(!isset($_SESSION))
{
    session_start();
}


if(isset($_SESSION['UserLogin']))
{
    echo "Welcome ".$_SESSION['UserLogin'];
}
else
{
    echo "Welcome Guest!";
}

include_once("connections/connections.php");
$con = connection();

$sql = "select * from student_info";
//MySQLi Function with 1 parameter
//die is equivalent of try catch in C# 
$students = $con->query($sql) or die ($con->error);
//MySQLi Function fetch_assoc() is to fetch data from sql query
$row = $students->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="css/style.css">   
</head>
<body>

    <div class="index-container">
        <h1>Student Information System</h1> 
        <br/>
        <br/>

        <div class="search-container">
            <form action="search.php" method="get">
                <input type="text" name="search" id="search" class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>

        <div class="button-container">
            <a href="">Send SMS</a>
            <a href="add.php">Add Student</a>
            <?php if(isset($_SESSION['UserLogin'])) { ?>    
                <a href="logout.php">Log out</a>
            <?php }else{ ?>
                <a href="login.php">Login</a>
            <?php } ?>                
        </div>
        
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>First Name</th>
                    <th>Last Name</th>  
                </tr>
            </thead>
            <tbody>
            <?php do{ ?>
                <tr>
                    <td width="30"><a href="details.php?ID=<?php echo $row['student_id']; ?>" class="button-view"> View </a></td>
                    <td><?php echo $row['first_name'];?> </td>
                    <td><?php echo $row['last_name'];?> </td>
                </tr>
            <?php }while($row = $students->fetch_assoc()); ?>
            </tbody>    
        </table>
    </div>

</body>
</html>