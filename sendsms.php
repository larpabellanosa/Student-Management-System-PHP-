<?php

if(isset($_POST['submit']))
{
    // User data to be send using HTTP POST method in URL
    $num = $_GET['Num'];
    $message = $_POST['message'];

    $data = array(
        'address' => $num,
        'message' => $message
    );

    $token = '8oovxo84FOHV-EOwN9sgocVDeuT0MKUFAZ1pfn_97XU';

    // Data should be passed as json format
    $data_json = json_encode($data);

    //API URL to send data
    $url = 'https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/0989/requests?access_token='.$token;

    // Curl Initiate
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Set Method as POST
    curl_setopt($ch, CURLOPT_POST, 1);

    // Pass user data in POST command
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Execute curl and assign returned data
    $response  = curl_exec($ch);

    // Close curl
    curl_close($ch);   

    // See response if data is posted successfully or any error
    //print_r ($response);
    echo "SMS was sent successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS</title>
</head>
<body>
    <h1>Send SMS to this Student</h1>
    <form action="" method="post">
        <label>Input Message</label>
        <input type="text" name="message" id="message">
        <button type="submit" name="submit">Send SMS</button>
    </form>    
</body>
</html>