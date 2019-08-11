<?php
// POSTS API

include('../config/connection.php');

header('Content-Type: application/json');

// FETCHING POST
if ($_SERVER['REQUEST_METHOD']=="GET"){
    if (isset($_GET['article_id'])){
        $article_id = $_GET['article_id'];
        $sql = "SELECT * FROM op_articles WHERE status='published' AND id='$article_id' ORDER BY id DESC";
    }
    else {
        $sql = "SELECT * FROM op_articles WHERE status='published' ORDER BY id DESC";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $user_id = $row['user_id'];
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
        $response = array("message" => "No News Available", "status" => "no_content");
    }
    $json = json_encode($response);
    echo $json;
}

// NEW POST
else if ($_SERVER['REQUEST_METHOD']=="POST"){
    header('Content-Type: application/json');
    $json = json_encode($_POST);
    echo $json;
}

// EDIT POST
else if ($_SERVER['REQUEST_METHOD']=="PUT"){
    header('Content-Type: application/json');
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

    if ((isset($_DELETE['article_id']))&&(isset($_DELETE['access_token']))){
        $access_token = $_DELETE['access_token'];
        $article_id = $_DELETE['article_id'];

        $sql = "SELECT * FROM op_articles WHERE id='$article_id' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $article = $result->fetch_assoc();
            $sql = "SELECT * FROM op_users WHERE token='$access_token' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if ($user['id']==$article['user_id']){
                    $response = array("message" => "Deleted Successfully", "status" => "success_delete");
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
            $response = array("message" => "Required Parameters (article_id,access_token)", "status" => "no_target_article_id");
        }
    }
    $json = json_encode($response);
    echo $json;
}

$conn->close();
?>