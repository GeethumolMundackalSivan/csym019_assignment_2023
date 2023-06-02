<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  margin-top: 50px; 
  margin-left: 10px;
  margin-right: -10px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid black;
}

th ,td{
  text-align: left;
  padding: 8px;
  background-color: azure;
  border: 1px solid black;
}

/* td {
  text-align: left;
  padding: 8px;
  background-color: azure;   
} */

tr:nth-child(even){background-color: #f2f2f2}

.delete-button {
  background-color: red;
}
</style>
</head>
<center>
<h1>Course Details</h1>
</center>
<body>


<?php
// Database connection parameters
$host = 'localhost';        
$username = 'geethu';    
$password = 'h4wea9ObZmxfuY.W';    
$database = 'internet_programming';    

// Establish a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteId'])) {
    // Get the ID of the row to delete
    $id = $_POST['deleteId'];

    // Perform the necessary logic to delete the row from the database
    $query = "DELETE FROM add_course WHERE course_Id = $id";
    $deleteResult = mysqli_query($connection, $query);

    if ($deleteResult) {
        // Deletion successful
        echo "Row deleted successfully.";
    } else {
        // Deletion failed
        echo "Failed to delete the row.";
    }
}

// Retrieve data from the database and display in HTML table
$query = "SELECT * FROM add_course";
$result = mysqli_query($connection, $query);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start creating the HTML table
    echo '<table>';
    echo '<tr>';
    //echo '<th>Select</th>';
    echo '<th>Course_Name</th>';
    echo '<th>Course_Highlights</th>';
    echo '<th>Course_Details</th>';
    echo '<th>Module1</th>';
    echo '<th>Module1_Credits</th>';
    echo '<th>Module2</th>';
    echo '<th>Module2_Credits</th>';
    echo '<th>Module3</th>';
    echo '<th>Module3_Credits</th>';
    echo '<th>Level</th>';
    echo '<th>Entry_Requirements</th>';
    echo '<th>Fees(GBP)</th>';
    echo '<th>International_Fees(GBP)</th>';
    echo '<th>Fees(EUR)</th>';
    echo '<th>International_Fees(EUR)</th>';
    echo '<th>Fees(USD)</th>';
    echo '<th>International_Fees(USD)</th>';
    echo '<th>Action</th>';
    echo '</tr>';

    // Loop through the rows and display data in table cells
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
      //  echo '<td><input type="checkbox" name="selectedCourses[]" value="' . $row['id'] . '"></td>';
        echo '<td>' . $row['course_Name'] . '</td>';
        echo '<td>' . $row['course_Highlights'] . '</td>';
        echo '<td>' . $row['course_Details'] . '</td>';
        echo '<td>' . $row['module1'] . '</td>';
        echo '<td>' . $row['module1_Credits'] . '</td>';
        echo '<td>' . $row['module2'] . '</td>';
        echo '<td>' . $row['module2_Credits'] . '</td>';
        echo '<td>' . $row['module3'] . '</td>';
        echo '<td>' . $row['module3_Credits'] . '</td>';
        echo '<td>' . $row['level'] . '</td>';
        echo '<td>' . $row['entry_Requirements'] . '</td>';
        echo '<td>' . $row['feesGBP'] . '</td>';
        echo '<td>' . $row['inter_FeesGBP'] . '</td>';
        echo '<td>' . $row['feesEUR'] . '</td>';
        echo '<td>' . $row['inter_FeesEUR'] . '</td>';
        echo '<td>' . $row['feesUSD'] . '</td>';
        echo '<td>' . $row['inter_FeesUSD'] . '</td>';
        echo '<td>
        <form method="post" action="">
            <input type="hidden" name="deleteId" value="' . $row['course_Id'] . '">
            <button type="submit" class="delete-button" >Delete</button>
        </form>
    </td>';
echo '</tr>';
}

// Close the table
echo '</table>';
} else {
echo 'No data found.';
}

// Close the database connection
mysqli_close($connection);
?>
</body>
</html>