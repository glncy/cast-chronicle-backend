<?php

// USER API

include('../config/connection.php');
include('../functions.php');

header('Content-Type: application/json');
$salt = "CASTCHRONICLE_PSULINGAYEN";

// LOG OUT USER
if ($_SERVER['REQUEST_METHOD']=="GET"){
    if (isset($_GET['access_token'])){
        $response = array("message" => "Logged Out Successfully", "status" => "success_logout");
    }
    else {
        $response = array("message" => "Required Parameters (access_token)", "status" => "no_parameters");
    }
    showResponse($response);
}
elseif ($_SERVER['REQUEST_METHOD']=="POST") {
    if ((isset($_POST['studentId']))&&(isset($_POST['pw']))){
        $studentId = htmlspecialchars($conn->real_escape_string($_POST['studentId']));
        $pw = md5($salt.$_POST['pw']);
        $sql = "SELECT id,fname,lname,studentId,role,course,dept FROM op_users WHERE studentId='$studentId' AND pw='$pw' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $response = array();
            $user = $result->fetch_assoc();
            $user_id = $user['id'];
            $random_token = md5($salt.rand(100000,999999).$user_id);
            $sql = "UPDATE op_users SET token='$random_token' WHERE id = '$user_id'";
            if ($conn->query($sql) or die($conn->error)) {
                $response[] = $user;
                $response[] = array("message" => "Login Successfully", "status" => "success_login", "access_token" => $random_token);
            }
            else{
                $response[] = array("message" => "Failed to Login due to Server Error", "status" => "server_error");
            }
        }
        else {
            $response = array("message" => "Invalid Student ID and Password", "status" => "invalid_login");
        }
    }
    else {
        $response = array("message" => "Required Parameters (studentId,pw)", "status" => "no_parameters");
    }
    showResponse($response);
}

?>