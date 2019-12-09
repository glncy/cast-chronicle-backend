<?php
include('process/auth.php');

$section = "copyreader-panel";

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
                <div class="col-sm-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-rejected" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h2>To Copyread Articles</h2>
                            <hr/>
                            <div class="row" style="padding-right: 20px; padding-left: 20px;">
                            <?php
                            if (isset($loopCnt)){
                            $loop = 0;
                            $loopIfAvail = 0;
                            while ($loop < $loopCnt) {
                                if ($obj[$loop]['status'] == "copyread"){
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
                                $loopIfAvail++;
                                }
                                $loop++;
                            }
                            if ($loopIfAvail==0){
                                ?>
                                <h4>No Articles to Copyread</h4>
                                <?php
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