<?php
include('process/auth.php');

$section = "writers-panel";

$pageSection = "edit";

include('../functions.php');

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => baseURL()."/api/article.php?access_token=".$_COOKIE['access_token']."&params=id,status,title,user_id,up_timestamp",
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
    }
    else {
        $loopCnt = count($obj);   
    }
}

// HEADER
include('../layout/header.php');
?>

<div class="row">
    <div class="col-sm-8">
        <div class="card mb-3">
            <div class="card-header">
                Compose Draft
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="article_title">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <div id="editor">
                        <br/><br/><br/><br/><br/>
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-sm float-right" onclick="confirmSubmit();" id="submitButton">Save Draft</button>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-header">
                Approved
            </div>
            <div class="card-body">
                <br/>
            </div>
            <div class="card-header">
                Pending
            </div>
            <div class="card-body">
                <br/>
            </div>
            <div class="card-header">
                Drafts
            </div>
            <div class="card-body">
                <br/>
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>