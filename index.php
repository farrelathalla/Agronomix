<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
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
    <title>Agronomix</title>

</head>
<body>
<section class="top-nav">
    <div class="nav-img">
        <img src="logo2.png">
    </div>
    <input id="menu-toggle" type="checkbox" />
    <label class='menu-button-container' for="menu-toggle">
    <div class='menu-button'></div>
    </label>
    <ul class="menu" style="top:40px">
        <li style="border-radius: 10px 10px 0 0;"> <a href="#C1"> Home </a> </li>
        <li> <a href="#C2">Stock Monitor </a> </li>
        <li> <a href="#C3">AgriInsight </a> </li>
        <li> <a href="#C4">AgriConnect </a></li>
        <li style="border-radius: 0 0 10px 10px;"> <a href="logout.php">Log Out</a></li>
    </ul>
</section>
    <div class="home" id="C1">
        <h3> Welcome to, </h3>
        <h1> Agronomix </h1>
        <br>
        <p> Your One-Stop Hub for Seamless Agriculture Connections. Discover a digital ecosystem where farmers,
            distributors, and consumers come together to cultivate a brighter future. Whether you are a
            grower seeking the perfect market, a distributor searching for quality produce, or a consumer
            craving fresh, sustainable options, Agronomix unites you in the world of agriculture. Join us in
            sowing the seeds of a greener, more connected tomorrow.</p>
            <div id="custom-dropdown" onclick="toggleDropdown()">
                <label for="language-select" style="font-size: 20px;background-color: #20c477;padding: 7px;border-radius: 10px;">Select your language</label>
                <div class="custom-options" id="language-options">
                    <div class="custom-option" onclick="changeLanguage('english', 'index.php')" style="border-radius:10px 10px 0 0 ;">
                        <img src="agro10.png" alt="English Flag" width="20px"> English
                    </div>
                    <div class="custom-option" onclick="changeLanguage('indonesia', 'index2.php')" style="border-radius: 0 0 10px 10px;">
                        <img src="agro10a.png" alt="Indonesia Flag" width="20px"> Indonesia
                    </div>
                </div>
            </div>
            <div class="custom-options2" id="language-options2" style="visibility:hidden;">
                <div class="custom-option2" style="border-radius:10px 10px 0 0 ;">
                    <img src="agro10.png" alt="English Flag"> English
                </div>
                <div class="custom-option2" style="border-radius: 0 0 10px 10px;">
                    <img src="agro10a.png" alt="Indonesia Flag"> Indonesia
                </div>
            </div>
    </div>
    <div class="stock" id="C2">
        <h1> Stock Monitor </h1>
        <p> Gain real-time insights into stock levels, enabling you to make informed decisions, streamline your operations, and meet market demands with precision.</p>
        <br><br>
        <h6> Select your area </h6>
        <div class="area">
            <a href="stock.html">
            <img src="pexels-quang-nguyen-vinh-6130912.jpg" style="float:left;">
            <div class="title"><h2>Jatinangor, <br> West Java </h2></div>
            </a>
        </div>
    </div>
    <div class="insight" id="C3">
        <h1> AgriInsight </h1>
        <p style="margin-bottom:10%;">Access the latest news, trends, and insights in the agricultural sector, all in one place.</p>
        <p> Latest Update </p><br><br><br>
            <div class="news-flex">
                <ul>
                    <li> <a href="news1a.html"><img src="1a.png"></a></li>
                    <li> <a href="news2a.html"><img src="2a.png"></a></li>
                    <li> <a href="news3a.html"><img src="3a.png"></a></li>
                    <li> <a href="news4a.html"><img src="4a.png"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="connect" id="C4">
        <h1> AgriConnect </h1>
        <p> AgriConnect is your virtual marketplace for fostering collaboration among farmers, distributors, and costumers.</p>
        <div style="position:relative;">
        <div class="chat-bar">

        </div>
        <div class="chat">
            <form method="post" class="chat-form" action="index.php" id="chatForm">
                <textarea name="chat_text" id="chat_text" placeholder="Enter a message" class="chat-area"> </textarea>
                <button type="submit" id="chat_button" class="chat-button"></button>
            </form>
        </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('chatForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        var chatText = document.getElementById('chat_text').value.trim();
        if (chatText === '') {
            // If the textarea is empty, do not proceed with the fetch request
            return;
        }
        
        // Fetch API to submit the form data asynchronously
        fetch('post.php', {
            method: 'POST',
            body: new FormData(event.target),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the chat container with the new HTML
                document.querySelector('.chat-bar').innerHTML = data.chatHtml;

                // Clear the textarea or perform any other necessary actions
                document.getElementById('chat_text').value = '';

                // Scroll to the bottom of the chat container
                var chatContainer = document.querySelector('.chat-bar');
                chatContainer.scrollTop = chatContainer.scrollHeight;
            } else {
                console.error('Error: Failed to insert chat message.');
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Initial fetch and display of chat messages
    fetch('post.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the chat container with the initial HTML
                document.querySelector('.chat-bar').innerHTML = data.chatHtml;

                // Scroll to the bottom of the chat container
                var chatContainer = document.querySelector('.chat-bar');
                chatContainer.scrollTop = chatContainer.scrollHeight;
            } else {
                console.error('Error: Failed to fetch initial chat messages.');
            }
        })
        .catch(error => console.error('Error:', error));
});
function toggleDropdown() {
        var options = document.getElementById("language-options");
        options.style.display = options.style.display === "none" ? "block" : "none";
    }

    function changeLanguage(value, url) {
        window.location.href = url;
    }

    document.addEventListener("click", function(event) {
        var dropdown = document.getElementById("custom-dropdown");
        if (!dropdown.contains(event.target)) {
            document.getElementById("language-options").style.display = "none";
        }
    });
</script>

</body>
</html>