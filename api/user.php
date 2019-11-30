<?php

// USER API

include('../config/connection.php');
include('../functions.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// FETCH ALL USERS

if ($_SERVER['REQUEST_METHOD']=="GET"){
    if (isset($_GET['user_id'])){
        // GET SPECIFIC USER
        $user_id = htmlspecialchars($conn->real_escape_string($_GET['user_id']));
        $sql = "SELECT * FROM op_users WHERE id='$user_id' LIMIT 1";    
    }
    else {
        // GET ALL USER
        $sql = "SELECT id,fname,lname,studentId,role,course,dept FROM op_users WHERE role!='admin'";
    }

    $result = $conn->query($sql) or die ($conn->error);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $response[] = $row;
        }
    }
    else {
        $response = array("message" => "No Articles Available", "status" => "no_content");
    }
    showResponse($response);
}

elseif ($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_GET['method'])){
        if ($_GET['method']=="change_password"){
            if ((isset($_POST['currentPw']))&&(isset($_POST['newPw']))&&(isset($_POST['retypeNewPw']))&&(isset($_POST['user_id']))){
                $user_id = htmlspecialchars($conn->real_escape_string($_POST['user_id']));
                $currentPw = htmlspecialchars($conn->real_escape_string($_POST['currentPw']));
                $newPw = htmlspecialchars($conn->real_escape_string($_POST['newPw']));
                $retypeNewPw = htmlspecialchars($conn->real_escape_string($_POST['retypeNewPw']));
                $salt = "CASTCHRONICLE_PSULINGAYEN";
                $hash = md5($salt.$currentPw);
                $newHash = md5($salt.$newPw);
                $sql = "SELECT * FROM op_users WHERE id='$user_id' AND pw='$hash'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    if ($retypeNewPw==$newPw){
                        $sql = "UPDATE op_users SET pw='$newHash' WHERE id='$user_id'";
                        if ($conn->query($sql)){
                            $response = array("message" => "Updated Successfully", "status" => "success_update");
                        }
                        else {
                            $response = array("message" => "Failed to Update due to Server Error", "status" => "server_error");
                        }
                    }
                    else {
                        $response = array("message" => "New Password Mismatch", "status" => "mismatch_pw");
                    }
                }
                else {
                    $response = array("message" => "Invalid Password", "status" => "invalid_password");   
                }
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
        $response = array("message" => "Denied Access", "status" => "no_access");
    }
    showResponse($response);
}

elseif ($_SERVER['REQUEST_METHOD']=="PATCH"){
    $data = file_get_contents('php://input');
    $_PATCH = array();
    parse_str($data,$_PATCH);
    
    if ((isset($_PATCH['change_role']))&&(isset($_PATCH['user_id']))&&(isset($_PATCH['role']))) {
        $user_id = htmlspecialchars($conn->real_escape_string($_PATCH['user_id']));
        $role = htmlspecialchars($conn->real_escape_string($_PATCH['role']));
        $sql = "UPDATE op_users SET role='$role' WHERE id='$user_id'";
        if ($conn->query($sql) or die ($conn->error)) {
            $response = array("message" => "Updated Successfully", "status" => "success_update");
        }
        else {
            $response = array("message" => "Failed to Update due to Server Error", "status" => "server_error");
        }
    }
    else {
        $response = array("message" => "Denied Access", "status" => "no_access");
    }
    showResponse($response);
}

?>