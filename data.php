<?php
header('Content-Type: application/json');

require 'header.php';
require_once('connect.php');

$sqlQuery = "SELECT * FROM sales_result ORDER BY id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>