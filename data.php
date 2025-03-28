<?php  
header('Content-Type: application/json');

include("connection.php"); // Include the correct connection file
$mysqli = new mysqli('localhost', 'root', '', 'mfa_car_wash'); // Updated DB name

$query = "SELECT COUNT(*) AS booking_no, DATE_FORMAT(`date`, '%M') AS MonthName FROM booking GROUP BY MonthName";
$result = $mysqli->query($query);

$data = array();

foreach ($result as $row) {
    $data[] = $row;
}

$result->close();
$mysqli->close();

print json_encode($data);
?>

