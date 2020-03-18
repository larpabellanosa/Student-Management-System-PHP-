<?php

if(!isset($_SESSION))
{
    session_start();
}

include_once("connections/connections.php");
$con = connection(); 

$id = $_GET['ID'];
$sql = "select * from student_info where student_id = '$id' ";
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();

if(isset($_POST['submit']))
{
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $bdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $bdate = date('Y-m-d',strtotime($_POST['birthdate']));

    $sql = "UPDATE `student_info` set `first_name` = '$fname', `last_name` = '$lname', `birth_date` = '$bdate' , 
    `gender` = '$gender' where student_id = '$id'";

    $con->query($sql) or die ($con->error);
    
    echo header("Location: index.php");
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
<body>
    <div class="add-container">
        <a href="index.php" class="button-view">Home</a>
        <h1>Edit Student Details</h1> 
        
        <form action="" method="post">
            <label>Firstname</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $row['first_name']; ?> ">
            
            <label>Lastname</label> 
            <input type="text" name="lastname" id="lastname" value="<?php echo $row['last_name']; ?> ">
            
            <label>Gender</label>
            <select name="gender" id="gender">
                                    <?php /*shorthand if statement */ ?>
                <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '' ?> > Male </option>
                <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '' ?> >Female</option>
            </select>
        
            <label>Birth Date</label>
            
            <input type="date" name="birthdate" id="birthdate" value="<?echo $row['birth_date']; ?> ">

            <input type="submit" name="submit" value="Submit">
        </form> 
    </div>
</body>
</html>