<?php

// AUTH API

include('../config/connection.php');
include('../functions.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$salt = "CASTCHRONICLE_PSULINGAYEN";

// CLEARING ALL EXPIRED ACCESS TOKEN IN DATABASE
$time = time();
$sql = "SELECT * FROM op_tokens WHERE expiration < '$time'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $token_id = $row['id'];
        $sql_delete = "DELETE FROM op_tokens WHERE id='$token_id'";
        $error_test = true;
        while ($error_test) {
            if ($conn->query($sql_delete)) {
                $error_test = false;
            }
            else {
                $error_test = true;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD']=="GET"){
    if (isset($_GET['access_token'])){
        $access_token = htmlspecialchars($conn->real_escape_string($_GET['access_token']));
        $sql = "SELECT * FROM op_tokens WHERE token='$access_token' LIMIT 1";
        $result = $conn->query($sql) or die($conn->error);
        if ($result->num_rows > 0){
            $token = $result->fetch_assoc();
            $user_id = $token['user_id'];
            $sql = "SELECT id,fname,lname,course,dept FROM op_users WHERE id='$user_id' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $response = $result->fetch_assoc();
            }
            else {
                $response = array("message" => "Denied Access", "status" => "no_access");
            }
        }
        else {
            $response = array("message" => "Denied Access", "status" => "no_access");
        }
    }
    else {
        $response = array("message" => "Required Parameters (access_token)", "status" => "no_parameters");
    }
    showResponse($response);
}

elseif ($_SERVER['REQUEST_METHOD']=="POST") {
    // LOGIN USER
    if ((isset($_POST['studentId']))&&(isset($_POST['pw']))){
        $studentId = htmlspecialchars($conn->real_escape_string($_POST['studentId']));
        $pw = md5($salt.$_POST['pw']);
        $sql = "SELECT id,fname,lname,studentId,role,course,dept FROM op_users WHERE studentId='$studentId' AND pw='$pw' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $response = array();
            $user = $result->fetch_assoc();
            $user_id = $user['id'];
            $time = strtotime('+30 days', time());
            $random_token = md5($salt.rand(100000,999999).$user_id.$time);
            $sql = "INSERT INTO op_tokens (user_id,token,expiration) VALUES ('$user_id','$random_token','$time')";
            if ($conn->query($sql) or die($conn->error)) {
                $response[] = array("message" => "Login Successfully", "status" => "success_login", "access_token" => $random_token, "expiration" => $time);
                $response[] = $user;
            }
            else{
                $response[] = array("message" => "Failed to Login due to Server Error", "status" => "server_error");
            }
        }
        else {
            $response[] = array("message" => "Invalid Student ID or Password", "status" => "invalid_login");
            //$response = array("student_info" => "not_available");
        }
    }
    // LOGOUT USER
    elseif (isset($_POST['access_token'])) {
        $access_token = htmlspecialchars($conn->real_escape_string($_POST['access_token']));
        $sql = "SELECT * FROM op_tokens WHERE token='$access_token' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $token = $result->fetch_assoc();
            $token_id = $token['id'];
            $sql = "DELETE FROM op_tokens WHERE id='$token_id'";
            if ($conn->query($sql)) {
                $response = array("message" => "Logout Successfully", "status" => "success_logout");
            }
            else {
                $response = array("message" => "Failed to Logout due to Server Error", "status" => "server_error");
            }
        }
        else {
            $response = array("message" => "Denied Access", "status" => "no_access");
        }
    }   
    else {
        $response = array("message" => "Required Parameters | Login (studentId,pw) | Logout (access_token)", "status" => "no_parameters");
    }
    showResponse($response);
}

$conn->close();

?>