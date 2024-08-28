<?php 
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		//something was posted
		$user_name = $_POST['user_name'];
        $first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$password = $_POST['password'];

        
        if(!empty($user_name) && !empty($password) && !empty($first_name) && !empty($last_name) && !is_numeric($user_name) && !is_numeric($first_name) && !is_numeric($last_name))
        {
            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,first_name,last_name,password) values ('$user_id','$user_name','$first_name','$last_name','$password')";
            
            mysqli_query($con, $query);

            header("Location: login.php");
                die;
        } else 
        {
            $error_message = "Please enter some valid information!";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="Agronomix">
    <meta name="description" content="Agronomix">
    <meta name="author" content="Institut Teknologi Bandung">
    <meta name="http-equiv" content="30">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" type="image/x-icon" href="logo.png">
    <title>Sign Up</title>

</head>

<body style="overflow-y:scroll;">
<div class="login">
        <div class="login-left">
            <div>
                <img src="agro6.png" width="250px">
            <br> <br> <br>
                <h2> Start your journey with us.</h2>
            <br>
            <p> Discover a digital ecosystem where farmers, distributors, and consumers come together to cultivate a brighter future. </p>
            </div>
            <br> <br>  
            <div class="desc">
                <p> Discovering Agronomix has been a game-changer for my agri pursuits! Real-time stock insights, top-notch ag news, and a slick chat system make this app a must-have for any ag enthusiast. User-friendly design and a supportive community seal the deal. Kudos to the developers! </p>
                <br>
                <p style="font-size: 12px;"> <i> - Mr. Asep (Farmer) </i></p>
            </div>
        </div>
        <div class="login-right">
            <div class="journey">
                <img src=agro6.png>
                <h3> Start your journey with, <br> Agronomix </h3>
            </div>  
            <h2> Sign Up </h2>
            <h6> Already have an account? <a href="login.php"> Log In </a></h6><br><br>
            <div class="box">
                <form method="post">
                    <h6 style="color:#B0B0B0"> Username </h6><br>
                    <input id="text" type="text" name="user_name" placeholder="Enter your username"><br><br><br>
                    <h6 style="color:#B0B0B0"> First Name </h6><br>
                    <input id="text" type="text" name="first_name" placeholder="Enter your first name"><br><br><br>
                    <h6 style="color:#B0B0B0"> Last name </h6><br>
                    <input id="text" type="text" name="last_name" placeholder="Enter your last name"><br><br><br>
                    <h6 style="color:#B0B0B0"> Password </h6> <br>
                    <input id="text" type="password" name="password" placeholder="Enter your password"><br><br><br>
                    <input id="button" type="submit" value="Sign Up"><br><br>
                    <?php
                    if (isset($error_message)) {
                        echo '<div style="color:red;">' . $error_message . '</div>';
                    }
                    ?>
                    <div style="margin-bottom:100px;"></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>