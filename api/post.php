<?php
// POSTS API

include('../config/connection.php');

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
        $response = array();
        while($row = $result->fetch_assoc()){
            $user_id = $row['user_id'];
            $getUserSql = "SELECT id,fname,lname FROM op_users WHERE id='$user_id' LIMIT 1";
            $getUserResult = $conn->query($getUserSql) or die($conn->error());
            if ($getUserResult->num_rows > 0){
                unset($row['user_id']);
                $user_details = $getUserResult->fetch_assoc();
                $row['user_details'] = $user_details;
            }
            $response[] = $row;
        }
        //print_r($response);
        header('Content-Type: application/json');
        $json = json_encode($response);
        echo $json;
    }
    else {
        header('Content-Type: application/json');
        $response = array("message" => "No News Available", "status" => "no_content");
        $json = json_encode($response);
        echo $json;
    }
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
    header('Content-Type: application/json');
    $data = file_get_contents('php://input');
    $_DELETE = array();
    parse_str($data,$_DELETE);
    $json = json_encode($_DELETE);
    echo $json;
}
?>