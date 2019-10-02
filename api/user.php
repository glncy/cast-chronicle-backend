<?php

// USER API

include('../config/connection.php');
include('../functions.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// FETCH ALL USERS

echo "<pre>";
print_r($_SERVER);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD']=="GET"){
    if (isset($_GET['user_id'])){
        // GET SPECIFIC USER
        $user_id = htmlspecialchars($conn->real_escape_string($_GET['user_id']));
        $sql = "SELECT * FROM op_users WHERE id='$user_id' LIMIT 1";    
    }
    else {
        // GET ALL USER
        $sql = "SELECT id,fname,lname,studentId,role,course,dept FROM op_users";
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

}

elseif ($_SERVER['REQUEST_METHOD']=="PATCH"){
    $data = file_get_contents('php://input');
    $_PATCH = array();
    parse_str($data,$_PATCH);

    echo $_PATCH;
    
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