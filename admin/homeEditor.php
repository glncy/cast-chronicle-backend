<?php
include('process/auth.php');

$section = "admin-panel";

$pageSection = "home";

include('../functions.php');

// HEADER
include('../config/connection.php');
include('../layout/header.php');

if (isset($_POST['homeData'])){
    $data = $conn->real_escape_string($_POST['homeData']);
    $sql = "UPDATE op_home SET body='$data'";
    if ($conn->query($sql)){
        echo "<script>alert('Updated!');</script>";
    }
    else {
        echo "<script>alert('Failed to Update Due to Server Error.');</script>";
    }
}

$sql = "SELECT * FROM op_home LIMIT 1";
$result = $conn->query($sql) or die ($conn->error);
$row = $result->fetch_assoc();
?>

<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card mb-3">
            <div class="card-body">
                <h2>
                    <strong>Homepage</strong>
                </h2>
                <hr/>
                <div id="editor">
                    <?php echo $row['body']; ?>
                </div>
                <br/>
                <form method="POST" id="homeForm">
                    <input type="hidden" name="homeData" id="homeData">
                </form>
                <button type="button" class="btn btn-success btn-block" onclick="saveHome();">Save</button>
            </div>
        </div>
    </div>
</div>
<?php
include('../layout/footer.php');
?>