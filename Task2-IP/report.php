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
input[type="submit"]{
    margin: 10px;
}

/* td {
  text-align: left;
  padding: 8px;
  background-color: azure;   
} */

tr:nth-child(even){background-color: #f2f2f2}

.delete-button {
  background-color: #ff0000;
}

.center {
            text-align: center;
        }
</style>
</head>
<center>
<h1>Course Report</h1>
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

// Retrieve data from the database and display in HTML table
$query = "SELECT * FROM add_course ORDER BY course_Name ASC";
$result = mysqli_query($connection, $query);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start creating the HTML table
    echo '<form method="post" action="view_report_Each.php">'; // Added the form start tag

    echo '<table>';
    echo '<tr>';
    echo '<th><input type="checkbox" id="checkAll" onclick="toCheckAll()"></th>';
    echo '<th>Course Name</th>';
    echo '<th>Course Highlights</th>';
    echo '<th>Course Details</th>';
    echo '<th>Module1</th>';
    echo '<th>Module1Credit</th>';
    echo '<th>Module2</th>';
    echo '<th>Module2Credit</th>';
    echo '<th>Module3</th>';
    echo '<th>Module3Credit</th>';
    echo '<th>Level</th>';
    echo '<th>Entry Requirement</th>';
    echo '<th>Fees(GBP)</th>';
    echo '<th>International Fees(GBP)</th>';
    echo '<th>Fees(EUR)</th>';
    echo '<th>International Fees(EUR)</th>';
    echo '<th>Fees(USD)</th>';
    echo '<th>International Fees(USD)</th>';
    echo '</tr>';

    // Loop through the rows and display data in table cells
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><input type="checkbox" name="checkedCourses[]" value="' . $row['course_Id'] . '"></td>';
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
        echo '</tr>';
    }

    echo '</table>';

    // Add JavaScript code for select-all checkbox functionality
    echo '<script>
        function toCheckAll() {
            var checkAllCheckbox = document.getElementById("checkAll");
            var checkboxes = document.getElementsByName("checkedCourses[]");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkAllCheckbox.checked;
            }
        }
    </script>';
    echo '<input type="submit" value="Generate Report" >'; // Moved the submit button inside the form
    echo '</form>'; // Added the form end tag
} else {
    echo 'No data found.';
}

// Close the database connection
mysqli_close($connection);
?>
</body>
</html>