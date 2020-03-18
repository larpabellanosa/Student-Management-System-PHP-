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

$search = $_GET['search'];

$sql = "select * from student_info WHERE first_name LIKE '%$search%' || last_name LIKE '%$search%'";
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
    <h1>Student Information System</h1> 
    <br/>
    <br/>

    <form action="search.php" method="get">
        <input type="text" name="search" id="search">
        <button type="submit">Search</button>
    </form>
    
    <?php if(isset($_SESSION['UserLogin'])){ ?>
    <a href="logout.php">Log out</a>
    <?php }else{ ?>
    <a href="login.php">Login</a>
    <?php } ?>
    <a href="add.php">Add New Student</a>
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
                <?php if(empty($row['first_name']) || empty($row['last_name'])){ ?>
                    <td>Student can't be found!</td>
                <?php }else { ?>
                    <td><a href="details.php?ID=<?php echo $row['student_id']; ?>"> View </a></td>
                    <td><?php echo $row['first_name'];?> </td>
                    <td><?php echo $row['last_name'];?> </td>
                <?php } ?>
            </tr>
        <?php }while($row = $students->fetch_assoc()); ?>
        </tbody>
    
    </table>
</body>
</html>