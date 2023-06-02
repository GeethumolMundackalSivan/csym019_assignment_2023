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
// Check if any courses were selected
if (isset($_POST['checkedCourses']) && !empty($_POST['checkedCourses'])) {
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

    // Get the selected course IDs
    $selectedCourses = $_POST['checkedCourses'];

    // Fetch course details for selected courses
    $query = "SELECT * FROM add_course WHERE course_Id IN (" . implode(',', $selectedCourses) . ") ORDER BY course_Name ASC";
    $result = mysqli_query($connection, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Start creating the HTML table for the report
        echo '<table>';
    echo '<tr>';
    //echo '<th>Select</th>';
    echo '<th>Course Name</th>';
    echo '<th>Course Highlights</th>';
    echo '<th>Course Details</th>';
    echo '<th>module1</th>';
    echo '<th>module1_Credits</th>';
    echo '<th>module2</th>';
    echo '<th>module2_Credits</th>';
    echo '<th>module3</th>';
    echo '<th>module3_Credits</th>';
    echo '<th>Level</th>';
    echo '<th>Entry Requirement</th>';
    echo '<th>Fees(GBP)</th>';
    echo '<th>International Fees(GBP)</th>';
    echo '<th>Fees(EUR)</th>';
    echo '<th>International Fees(EUR)</th>';
    echo '<th>Fees(USD)</th>';
    echo '<th>International Fees(USD)</th>';
    // echo '<th>Action</th>';
    echo '</tr>';

        // Array to store data for pie chart
        $chartData = array();

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
            echo '</tr>';

            // Add data for pie chart
            $chartData[] = [
                'label' => $row['module1'],
                'credit' => $row['module1_Credits']
            ];
            $chartData[] = [
                'label' => $row['module2'],
                'credit' => $row['module2_Credits']
            ];
            $chartData[] = [
                'label' => $row['module3'],
                'credit' => $row['module3_Credits']
            ];
        }

        echo '</table>';

        // Generate pie chart using Chart.js
        echo '<canvas id="pieChart"></canvas>';
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo '<script>';
        echo 'var ctx = document.getElementById("pieChart").getContext("2d");';
        echo 'var data = {';
        echo 'labels: [';

        // Generate labels for pie chart
        foreach ($chartData as $data) {
            echo '"' . $data['label'] . '", ';
        }

        echo '],';
        echo 'datasets: [{';
        echo 'data: [';

        // Generate values for pie chart
        foreach ($chartData as $data) {
            echo $data['credit'] . ', ';
        }

        echo '],';
        echo 'backgroundColor: [';

        // Generate background colors for pie chart slices
        for ($i = 0; $i < count($chartData); $i++) {
            echo '"' . generateRandomColor() . '", ';
        }

        echo '],';
        echo 'borderWidth: 1';
        // echo 'size:500px';
        echo '}]';
        echo '};';
        echo 'var pieChart = new Chart(ctx, {';
        echo 'type: "pie",';
        echo 'data: data';
        echo '});';
        echo '</script>';

        // Generate bar chart for multiple courses if more than one course is selected
        if (count($selectedCourses) > 1) {
            // Prepare data for bar chart
            $barChartLabels = array();  // Labels for x-axis
            $barChartData = array();    // Data values for bars

            // Fetch course names and module credits for selected courses
            $query = "SELECT course_Name, module1_Credits, module2_Credits, module3_Credits FROM add_course WHERE course_Id IN (" . implode(',', $seIectedCourses) . ") ORDER BY course_Name ASC";
            $result = mysqli_query($connection, $query);

            // Loop through the rows and collect data for bar chart
            while ($row = mysqli_fetch_assoc($result)) {
                $course_Name = $row['course_Name'];
                $module1_Credits = $row['module1_Credits'];
                $module2_Credits = $row['module2_Credits'];
                $module3_Credits = $row['module3_Credits'];

                // Add course name to bar chart labels
                $barChartLabels[] = $course_Name;

                // Add module credits to bar chart data
                $barChartData[] = array(
                    'label' => 'Module 1',
                    'credit' => $module1_Credits
                );
                $barChartData[] = array(
                    'label' => 'Module 2',
                    'credit' => $module2_Credits
                );
                $barChartData[] = array(
                    'label' => 'Module 3',
                    'credit' => $module3_Credits
                );
            }

            // Display bar chart
            echo '<canvas id="barChart"></canvas>';
            echo '<script>';
            echo 'var ctx = document.getElementById("barChart").getContext("2d");';
            echo 'var data = {';
            echo 'labels: ' . json_encode($barChartLabels) . ',';
            echo 'datasets: [';

            // Generate datasets for bar chart
            foreach ($barChartData as $data) {
                echo '{';
                echo 'label: "' . $data['label'] . '",';
                echo 'data: [' . $data['credit'] . '],';
                echo 'backgroundColor: "' . generateRandomColor() . '",';
                echo 'borderWidth: 1';
                echo '},';
            }

            echo ']';
            echo '};';
            echo 'var barChart = new Chart(ctx, {';
            echo 'type: "bar",';
            echo 'data: data,';
            echo 'options: {';
            echo 'scales: {';
            echo 'y: {';
            echo 'beginAtZero: true';
            echo '}';
            echo '}';
            echo '}';
            echo '});';
            echo '</script>';
        }
    } else {
        echo 'No data found.';
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo 'No courses selected.';
}

// Function to generate random hexadecimal color code
function generateRandomColor()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
?>
</body></html>