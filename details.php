<?php

//study more about session
//study more about isset method
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['Access']) && $_SESSION['Access'] == 'Administrator')
{
    echo "Welcome ".$_SESSION['UserLogin'];
}
else
{
    echo header("Location: index.php");
}

include_once("connections/connections.php");
$con = connection(); 

$id = $_GET['ID'];
$sql = "select * from student_info where student_id = '$id'";
//MySQLi Function with 1 parameter
//die is equivalent of try catch in C# 
$students = $con->query($sql) or die ($con->error);
//MySQLi Function fetch_assoc() is to fetch data from sql query
$row = $students->fetch_assoc();

// do{
//     echo $row['first_name']." ".$row['last_name']."<br/>";

// }while($row = $students->fetch_assoc());

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
    <div class="details-container">
        <h1>Student Details</h1> 
    
        <table>
            <thead>
                <tr>                               
                    <th>First Name</th>
                    <th>Last Name</th>  
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Mobile Number</th>
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                <tr>                          
                    <td><?php echo $row['first_name'];?> </td>
                    <td><?php echo $row['last_name'];?> </td>
                    <td><?php echo $row['gender'];?> </td>
                    <td><?php echo $row['birth_date'];?> </td>
                    <td><?php echo $row['mobile_num'];?> </td>
                    <td width="50"><a href="sendsms.php?Num=<?php echo $row['mobile_num'];?>" class="button-view"> Send SMS </a></td>  
                    <td width="50"><a href="edit.php?ID=<?php echo $row['student_id'];?>" class="button-view"> Edit </a></td>   
                    <td width="50"><a href="delete.php?ID=<?php echo $row['student_id'];?>" class="button-view">Delete</a></td>   
                </tr>
            </tbody>
        </table>
    </div>
    
</body>
</html>