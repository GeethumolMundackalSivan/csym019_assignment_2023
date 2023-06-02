<?php

$host = 'localhost';
$dbname = 'internet_programming';
$user = 'geethu';
$password = 'h4wea9ObZmxfuY.W';

$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$course_Name = $_POST['course_Name'];
$course_Highlights = $_POST['course_Highlights'];
$course_Details = $_POST['course_Details'];
$module1=$_POST['module1'];
$module1_Credits= $_POST['module1_Credits'];
$module2=$_POST['module2'];
$module2_Credits= $_POST['module2_Credits'];
$module3=$_POST['module3'];
$module3_Credits= $_POST['module3_Credits'];
$level = $_POST['level'];
$entry_Requirements = $_POST['entry_Requirements'];
$feesGBP = $_POST['feesGBP'];
$inter_FeesGBP = $_POST['inter_FeesGBP'];
$feesEUR = $_POST['feesEUR'];
$inter_FeesEUR = $_POST['inter_FeesEUR'];
$feesUSD = $_POST['feesUSD'];
$inter_FeesUSD= $_POST['inter_FeesUSD'];
$sql = "INSERT INTO add_course (course_Name,course_Highlights,course_Details, module1, module1_Credits, module2, module2_Credits,  module3, module3_Credits, level, entry_Requirements, feesGBP, inter_FeesGBP, feesEUR, inter_FeesEUR, feesUSD, inter_FeesUSD) VALUES (:course_Name,:course_Highlights, :course_Details, :module1, :module1_Credits, :module2, :module2_Credits,  :module3, :module3_Credits, :level, :entry_Requirements, :feesGBP, :inter_FeesGBP, :feesEUR, :inter_FeesEUR, :feesUSD, :inter_FeesUSD)";
$stmt = $db->prepare($sql);

$stmt->bindParam(':course_Name', $course_Name);
$stmt->bindParam(':course_Highlights', $course_Highlights);
$stmt->bindParam(':course_Details', $course_Details);
$stmt->bindParam(':module1', $module1);
$stmt->bindParam(':module1_Credits', $module1_Credits);
$stmt->bindParam(':module2', $module2);
$stmt->bindParam(':module2_Credits', $module2_Credits);
$stmt->bindParam(':module3', $module3);
$stmt->bindParam(':module3_Credits', $module3_Credits);
$stmt->bindParam(':level', $level);
$stmt->bindParam(':entry_Requirements', $entry_Requirements);
$stmt->bindParam(':feesGBP', $feesGBP);
$stmt->bindParam(':inter_FeesGBP', $inter_FeesGBP);
$stmt->bindParam(':feesEUR', $feesEUR);
$stmt->bindParam(':inter_FeesEUR', $inter_FeesEUR);
$stmt->bindParam(':feesUSD', $feesUSD);
$stmt->bindParam(':inter_FeesUSD', $inter_FeesUSD);

if ($stmt->execute()) {
    // Data inserted successfully
    // "Data stored in the database.";
    $message = "Data stored in the database.";
    echo "<script>alert('$message');</script>";
    header('Location: user_home.html');
    exit();

} else {
    // An error occurred
    echo "Error: Unable to store data.";
}

$db=null;

?>