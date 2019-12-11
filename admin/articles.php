<?php
include('process/auth.php');

$section = "admin-panel";

$pageSection = "articles";

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
    <div class="col-sm-12">
        <div class="card mb-3">
            <div class="row p-3">
                <div class="col-sm-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-pending" role="tab" aria-controls="v-pills-home" aria-selected="true">Pending</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-rejected" role="tab" aria-controls="v-pills-profile" aria-selected="false">Copyread</a>
                        <!-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-rejected" role="tab" aria-controls="v-pills-messages" aria-selected="false">Rejected</a> -->
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-published" role="tab" aria-controls="v-pills-messages" aria-selected="false">Published</a>
                        <a class="nav-link" id="v-pills-archived-tab" data-toggle="pill" href="#v-pills-archived" role="tab" aria-controls="v-pills-messages" aria-selected="false">Archived</a>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-pending" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <h2>Pending Articles</h2>
                            <hr/>
                            <div class="row" style="padding-right: 20px; padding-left: 20px;">
                            <?php
                            if (isset($loopCnt)){
                            $loop = 0;
                            while ($loop < $loopCnt) {
                                if ($obj[$loop]['status'] == "pending"){
                            ?>
                            <div class="col-sm-12" style="padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px;box-shadow: -1px 1px 3px rgba(0,0,0,0.3); border-radius: 5px;">
                                <a href="#" onclick="openLink('<?php echo $obj[$loop]['id']; ?>')" style="text-decoration: none;">
                                    <h4><strong><?php echo $obj[$loop]['title']; ?></strong></h4>
                                    <p>
                                    <?php echo $obj[$loop]['user_details']['fname']; ?>&nbsp<?php echo $obj[$loop]['user_details']['lname']; ?><br/>
                                        <?php echo $obj[$loop]['date_time']; ?>
                                    </p>
                                </a>                            
                            </div>
                            <?php
                                }
                                $loop++;
                            }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-rejected" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h2>Copyread Articles</h2>
                            <hr/>
                            <div class="row" style="padding-right: 20px; padding-left: 20px;">
                            <?php
                            if (isset($loopCnt)){
                            $loop = 0;
                            while ($loop < $loopCnt) {
                                if (($obj[$loop]['status'] == "rejected")||($obj[$loop]['status'] == "copyread")){
                            ?>
                            <div class="col-sm-12" style="padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px;box-shadow: -1px 1px 3px rgba(0,0,0,0.3); border-radius: 5px;">
                                <a href="#" onclick="openLink('<?php echo $obj[$loop]['id']; ?>')" style="text-decoration: none;">
                                    <h4><strong><?php echo $obj[$loop]['title']; ?></strong></h4>
                                    <p>
                                        <?php echo $obj[$loop]['user_details']['fname']; ?>&nbsp<?php echo $obj[$loop]['user_details']['lname']; ?><br/>
                                        <?php echo $obj[$loop]['date_time']; ?>
                                    </p>
                                </a>                            
                            </div>
                            <?php
                                }
                                $loop++;
                            }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-published" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <h2>Published Articles</h2>
                            <hr/>
                            <div class="row" style="padding-right: 20px; padding-left: 20px;">
                            <?php
                            if (isset($loopCnt)){
                            $loop = 0;
                            while ($loop < $loopCnt) {
                                if ($obj[$loop]['status'] == "published"){
                            ?>
                            <div class="col-sm-12" style="padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px;box-shadow: -1px 1px 3px rgba(0,0,0,0.3); border-radius: 5px;">
                                <a href="#" onclick="openLink('<?php echo $obj[$loop]['id']; ?>')" style="text-decoration: none;">
                                    <h4><strong><?php echo $obj[$loop]['title']; ?></strong></h4>
                                    <p>
                                        <?php echo $obj[$loop]['date_time']; ?>
                                    </p>
                                </a>                            
                            </div>
                            <?php
                                }
                                $loop++;
                            }
                            }
                            ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-archived" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <h2>Archived Articles</h2>
                            <hr/>
                            <div class="row" style="padding-right: 20px; padding-left: 20px;">
                            <?php
                            if (isset($loopCnt)){
                            $loop = 0;
                            while ($loop < $loopCnt) {
                                if ($obj[$loop]['status'] == "archived"){
                            ?>
                            <div class="col-sm-12" style="padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px;box-shadow: -1px 1px 3px rgba(0,0,0,0.3); border-radius: 5px;">
                                <a href="#" onclick="openLink('<?php echo $obj[$loop]['id']; ?>')" style="text-decoration: none;">
                                    <h4><strong><?php echo $obj[$loop]['title']; ?></strong></h4>
                                    <p>
                                    <?php echo $obj[$loop]['user_details']['fname']; ?>&nbsp<?php echo $obj[$loop]['user_details']['lname']; ?><br/>
                                        <?php echo $obj[$loop]['date_time']; ?>
                                    </p>
                                </a>                            
                            </div>
                            <?php
                                }
                                $loop++;
                            }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../layout/footer.php');
?>