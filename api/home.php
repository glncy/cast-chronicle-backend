<?php

// AUTH API

include('../config/connection.php');
include('../functions.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$sql = "SELECT * FROM op_home LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
showResponse($row);

$conn->close();

?>