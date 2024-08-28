<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $user_data['user_id'];
    $chat_text = $_POST['chat_text'];

    // Insert the chat into the database
    $query = "INSERT INTO chat (userid, chat, date) VALUES ('$user_id', '$chat_text', NOW())";
    $result = mysqli_query($con, $query);

    if (!$result) {
        // If insertion fails, you can return an error response
        echo json_encode(['success' => false, 'error' => 'Failed to insert chat message']);
        exit();
    }
}

// Fetch and display chat messages
$chat_query = "SELECT u.user_name, c.chat, c.date, u.first_name, u.last_name FROM chat c INNER JOIN users u ON c.userid = u.user_id ORDER BY c.date ASC";
$chat_result = mysqli_query($con, $chat_query);

// Prepare the HTML for chat messages
$chat_html = '';
while ($row = mysqli_fetch_assoc($chat_result)) {
    $messageClass = ($row['user_name'] === $user_data['user_name']) ? 'user-message' : 'other-user-message';
    
    $chat_html .= "<div class='chat-message $messageClass'>";
    $chat_html .= "<div class='message-header'>";
    $chat_html .= "<span class='user-name'>{$row['first_name']} {$row['last_name']}</span>";
    $chat_html .= "<span class='message-date'>{$row['date']}</span>";
    $chat_html .= "</div>";
    $chat_html .= "<div class='message-content'>{$row['chat']}</div>";
    $chat_html .= "</div>";
}

// Return JSON response with chat HTML
echo json_encode(['success' => true, 'chatHtml' => $chat_html]);
?>
