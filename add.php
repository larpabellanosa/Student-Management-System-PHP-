<?php

include_once("connections/connections.php");

$con = connection(); 

if(isset($_POST['submit']))
{  
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $bdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $dadded = date('Y-m-d H:i:s');

    if(empty($fname) || empty($lname) || empty($bdate))
    {
        echo "Please complete details!";
    }
    else
    {
        $sql = "INSERT INTO `student_info`(`first_name`, `last_name`, `birth_date`, `gender`, `date_added`)
        VALUES ('$fname','$lname','$bdate','$gender','$dadded')";
    
        $con->query($sql) or die ($con->error);  
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
<body>
    <div class="add-container">
        <h1>Add New Student</h1>
        <form action="" method="post">
            <label>First Name</label>
            <input type="text" name="firstname" id="search" placeholder="Enter First Name" required>
            <br/>
            <br/>
            <label>Last Name</label>
            <input type="text" name="lastname" id="search" placeholder="Enter Last Name" required>
            <br/>
            <br/>
            <label>Birth Date</label>
            <input type="date" name="birthdate" id="birthdate">
            <br/>
            <br/>
            <label>Gender</label>
            <select name="gender" id="gender">
                <option value="">--select gender--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br/>
            <br/>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>        
</body>
</html>

