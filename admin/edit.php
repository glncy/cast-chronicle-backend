<?php
include('process/auth.php');

$section = "admin-panel";

$pageSection = "edit";

include('../functions.php');

$article_id = $_GET['id'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => baseURL()."/api/article.php?access_token=".$_COOKIE['access_token']."&article_id=".$article_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $obj = json_decode($response, true);

    if (isset($obj['status'])){
        if ($obj['status']=="no_access") {
            header("Location: logout.php");
        }
        elseif ($obj['status']=="no_content"){
            header("Location: error/404.php");
        }
    }
    else {
        $loopCnt = count($obj);   
    }
}

// HEADER
include('../config/connection.php');
include('../layout/header.php');
?>

<div class="row">
    <div class="col-sm-8">
        <div class="card mb-3">
            <div class="card-body">
                <h2>
                    <strong><?php echo $obj[0]['title']; ?></strong>
                </h2>
                <h6>
                    Category: <strong><?php 
                    $category = json_decode($obj[0]['category'],true);
                    $catCount = count($category);
                    $loop=0;
                    while ($loop<$catCount){
                        if ($loop+1 == $catCount){
                            echo ucfirst($category[$loop]);
                        }
                        else {
                            echo ucfirst($category[$loop]).", ";
                        }
                        $loop++;
                    } 
                    ?></strong>
                </h6>
                <hr/>
                <div id="editor" class="ql-container ql-snow ql-editor">
                    <?php echo $obj[0]['body']; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-header">
                Actions
            </div>
            <div class="card-body">
                <?php
                    if (($obj[0]['status']=="pending")||($obj[0]['status']=="rejected")||($obj[0]['status']=="copyread")) {
                ?>
                <button type="button" class="btn btn-success btn btn-block" onclick="setPublish();" id="approveButton">Approve and Publish</button>
                <button type="button" class="btn btn-danger btn btn-block" onclick="setReject();" id="rejectButton">Copyread to Writer</button>
                <button type="button" class="btn btn-danger btn btn-block" onclick="setRejectCopyreader();" id="rejectButton2">Copyread to Copyreader</button>
                <hr/>
                <textarea class="form-control" id="remarksBody"></textarea>
                <div class="p-1"></div>
                <button type="button" class="btn btn-default btn btn-block" onclick="addRemarks();" id="unpublishButton">Add Remarks</button>
                <?php
                    }
                    elseif ($obj[0]['status']=="published") {
                ?>
                <button type="button" class="btn btn-info btn btn-block" onclick="setUnpublish();" id="unpublishButton">Unpublish</button>
                <?php
                    }
                    else {
                ?>
                <center>No Action. This Article is Archived.</center>
                <?php
                    }
                ?>
            </div>
            <div class="card-header">
                Remarks
            </div>
            <div class="card-body" id="showRemarks">
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>