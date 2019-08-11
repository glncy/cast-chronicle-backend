<?php
// POSTS API

include('../config/connection.php');
include('../functions.php');

header('Content-Type: application/json');

// FETCHING POST
if ($_SERVER['REQUEST_METHOD']=="GET"){
    // SPECIFIC ARTICLE
    if (isset($_GET['article_id'])){
        $article_id = htmlspecialchars($conn->real_escape_string($_GET['article_id']));
        $sql = "SELECT * FROM op_articles WHERE status='published' AND id='$article_id' ORDER BY id DESC";
    }
    // ALL ARTICLE
    else {
        $sql = "SELECT * FROM op_articles WHERE status='published' ORDER BY id DESC";
    }
    $result = $conn->query($sql);

    // CHECK IF THERE IS ARTICLES
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $user_id = $row['user_id'];
            $row['body'] = htmlspecialchars_decode($row['body']);
            $getUserSql = "SELECT id,fname,lname,course,dept FROM op_users WHERE id='$user_id' LIMIT 1";
            $getUserResult = $conn->query($getUserSql) or die($conn->error());
            if ($getUserResult->num_rows > 0){
                unset($row['user_id']);
                $user_details = $getUserResult->fetch_assoc();
                $row['user_details'] = $user_details;
            }
            $response[] = $row;
        }
    }
    else {
        $response = array("message" => "No Articles Available", "status" => "no_content");
    }

    showResponse($response);
}

// NEW POST
else if ($_SERVER['REQUEST_METHOD']=="POST"){
    if ((isset($_POST['access_token']))&&(isset($_POST['title']))&&(isset($_POST['body'])&&(isset($_POST['status'])))){
        $access_token = htmlspecialchars($conn->real_escape_string($_POST['access_token']));
        $sql = "SELECT * FROM op_users WHERE token='$access_token' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $user = $result->fetch_assoc();
            $user_id = $user['id'];
            $title = $conn->real_escape_string($_POST['title']);
            $status = $conn->real_escape_string($_POST['status']);
            $body = htmlspecialchars($conn->real_escape_string($_POST['body']));
            $time = time();
            $sql = "INSERT INTO op_articles (user_id,title,body,status,up_timestamp) VALUES ('$user_id','$title','$body','$status','$time')";
            if ($conn->query($sql)) {
                $response = array("message" => "Added Successfully", "status" => "success_added_article");
            }
            else {
                $response = array("message" => "Failed to Add due to Server Error", "status" => "server_error");
            }
        }
        else {
            $response = array("message" => "Denied Access", "status" => "no_access");
        }
    }
    else{
        $response = array("message" => "Required Parameters (access_token,title,body,status)", "status" => "no_parameters");
    }
    showResponse($response);
}

// EDIT POST
else if ($_SERVER['REQUEST_METHOD']=="PUT"){
    $data = file_get_contents('php://input');
    $_PUT = array();
    parse_str($data,$_PUT);
    $json = json_encode($_PUT);
    echo $json;
}

// DELETE POST
else if ($_SERVER['REQUEST_METHOD']=="DELETE"){
    // GET DELETE REQUEST DATA
    $data = file_get_contents('php://input');
    $_DELETE = array();
    parse_str($data,$_DELETE);

    // CHECK IF article_id AND access_token IS EXISTING
    if ((isset($_DELETE['article_id']))&&(isset($_DELETE['access_token']))){
        $access_token = htmlspecialchars($conn->real_escape_string($_DELETE['access_token']));
        $article_id = htmlspecialchars($conn->real_escape_string($_DELETE['article_id']));
        // CHECK ARTICLE IF EXISTING
        $sql = "SELECT * FROM op_articles WHERE id='$article_id' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            // CHECK TOKEN IF EXISTING
            $article = $result->fetch_assoc();
            $sql = "SELECT * FROM op_users WHERE token='$access_token' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                // CHECK IF IT HAS ACCESS TO THE ARTICLE
                if ($user['id']==$article['user_id']){
                    $sql = "DELETE FROM op_articles WHERE id='$article_id'";
                    if ($conn->query($sql)){
                        $response = array("message" => "Deleted Successfully", "status" => "success_delete");
                    }
                    else {
                        $response = array("message" => "Failed to Delete due to Server Error", "status" => "server_error");
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
            $response = array("message" => "No Article Found", "status" => "no_article");
        }
    }

    else {
        if (isset($_DELETE['article_id'])){
            $response = array("message" => "Required Access Token", "status" => "no_access_token");
        }
        else if (isset($_DELETE['access_token'])){
            $response = array("message" => "Required Article ID", "status" => "no_target_article_id");
        }
        else {
            $response = array("message" => "Required Parameters (article_id,access_token)", "status" => "no_parameters");
        }
    }
    showResponse($response);
}


$conn->close();
?>