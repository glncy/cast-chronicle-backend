<?php
include('process/auth.php');

$section = "writers-panel";

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
include('../layout/header.php');
?>

<div class="row">
    <div class="col-sm-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="article_title" value="<?php echo $obj[0]['title']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select id="category" class="form-control">
                                <option <?php echo ($obj[0]['category'] == "news") ? "selected" : "" ; ?> value="news" >News</option>
                                <option <?php echo ($obj[0]['category'] == "devcomm") ? "selected" : "" ; ?> value="devcomm">Devcomm</option>
                                <option <?php echo ($obj[0]['category'] == "feature") ? "selected" : "" ; ?> value="feature">Feature</option>
                                <option <?php echo ($obj[0]['category'] == "sports") ? "selected" : "" ; ?> value="sports">Sports</option>
                                <option <?php echo ($obj[0]['category'] == "editorial") ? "selected" : "" ; ?> value="editorial">Editorial</option>
                                <option <?php echo ($obj[0]['category'] == "opinion") ? "selected" : "" ; ?> value="opinion">Opinion</option>
                                <option <?php echo ($obj[0]['category'] == "literary") ? "selected" : "" ; ?> value="literary">Literary</option>
                                <option <?php echo ($obj[0]['category'] == "photojourn") ? "selected" : "" ; ?> value="literary">Photo Journalism</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <div id="editor">
                        <?php echo $obj[0]['body']; ?>
                    </div>
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
                <button type="button" class="btn btn-success btn btn-block" onclick="confirmSubmit();" id="submitButton">Save Draft</button>
                <?php
                    if (($obj[0]['status']=="draft")||($obj[0]['status']=="rejected")) {
                ?>
                <button type="button" class="btn btn-info btn btn-block" onclick="setForApproval();" id="approvalButton">Submit for Approval</button>
                <button type="button" class="btn btn-danger btn btn-block" onclick="confirmDelete();" id="deleteButton">Delete</button>
                <?php
                    }
                    elseif ($obj[0]['status']=="pending") {
                ?>
                <button type="button" class="btn btn-info btn btn-block" onclick="setForApproval();" id="approvalButton">Update</button>
                <button type="button" class="btn btn-danger btn btn-block" onclick="confirmDelete();" id="deleteButton">Delete</button>
                <?php
                    }
                    elseif ($obj[0]['status']=="published") {
                ?>
                <br/>   
                <center>This Article is Live now. Once changes was Saved as Draft, it should be reviewed again to make it Live.</center>
                <?php
                    }
                ?>
            </div>
            <div class="card-header">
                Remarks
            </div>
            <div class="card-body">
            <?php
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => baseURL()."/api/remark.php?article_id=".$article_id,
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
                $objRemark = json_decode($response, true);
            
                if (isset($objRemark[0]['status'])){
                    echo "No Remarks";
                }
                else {
                    $loopCnt = count($objRemark);
                    $loop = 0;
                    echo "<ol>";
                    while ($loop < $loopCnt){
                        echo "<li>".$objRemark[$loop]['body']."</li>";
                        $loop++;
                    }
                    echo "</ol>";
                }
            }
            ?>
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>