<?php

$host = 'localhost';
$dbname = 'internet_programming';
$user = 'geethu';
$password = 'h4wea9ObZmxfuY.W';

$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM login_user WHERE username = :username AND password = :password";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);

$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

//echo json_encode($result) ;

// Verify the password
if ($result) {
    header('Location: user_home.html');
    exit();
} else {
    // Authentication failed, redirect back to the login page with an error message
   echo "invalid username or password";
    exit();
}

?>