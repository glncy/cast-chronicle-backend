<?php

// ARTICLE API

include('../config/connection.php');
include('../functions.php');

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// FETCHING POST
if ($_SERVER['REQUEST_METHOD']=="GET"){
    if (isset($_GET['article_id'])){
        $article_id = $conn->real_escape_string($_GET['article_id']);
        $sql = "SELECT * FROM op_remarks WHERE target_id='$article_id' ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                $response[] = $row;
            }
        } else {
            $response[] = array("message" => "No Remarks", "status" => "no_remarks");
        }
    }
    showResponse($response);
}

elseif ($_SERVER['REQUEST_METHOD']=="POST"){
    if ((isset($_POST['remarks']))&&(isset($_POST['article_id']))){
        $remarks = $conn->real_escape_string($_POST['remarks']);
        $article_id = $conn->real_escape_string($_POST['article_id']);
        $sql = "INSERT INTO op_remarks (target_id,body) VALUES ('$article_id','$remarks')";
        if ($conn->query($sql) or die ($conn->error)) {
            $response = array("message" => "Added Successfully", "status" => "success_add");
        }
        else {
            $response = array("message" => "Failed to Add due to Server Error", "status" => "server_error");
        }
    }
    // else {
        
    // }
    showResponse($response);
}

elseif ($_SERVER['REQUEST_METHOD']=="DELETE"){
    // GET DELETE REQUEST DATA
    $data = file_get_contents('php://input');
    $_DELETE = array();
    parse_str($data,$_DELETE);

    if (isset($_DELETE['id'])){
        $id = $_DELETE['id'];
        $sql = "DELETE FROM op_remarks WHERE id='$id'";
        if ($conn->query($sql)){
            $response = array("message" => "Deleted Successfully", "status" => "success_delete");
        }
        else {
            $response = array("message" => "Failed to Delete due to Server Error", "status" => "server_error");
        }
    }
    showResponse($response);
}