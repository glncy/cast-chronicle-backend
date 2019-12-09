<?php
include('process/auth.php');

$section = "writers-panel";

$pageSection = "about";

include('../functions.php');

// HEADER
include('../config/connection.php');
include('../layout/header.php');
$id = $_SESSION['writer_id'];

$sql = "SELECT * FROM op_users WHERE id='$id' LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-body">
                <h4>
                    <strong>Change Password</strong>
                </h4>
                <hr/>
                <form action="process/change_password.php" method="POST" id="submitPassword">
                <label>Current Password</label>
                <input type="password" name="currentPw" class="form-control">
                <label>New Password</label>
                <input type="password" name="newPw" class="form-control">
                <label>Retype Password</label>
                <input type="password" name="retypeNewPw" class="form-control">
                </form>
                <br/>
                <button type="button" class="btn btn-success btn-block" onclick="document.getElementById('submitPassword').submit();">Change</button>
            </div>
        </div>
    </div>
</div>
<script>
// function readURL(input) {
//   if (input.files && input.files[0]) {
//     var reader = new FileReader();
    
//     reader.onload = function(e) {
//       $('#imgOut').attr('src', e.target.result);
//       document.getElementById('imgContainer').value = e.target.result;
//       document.getElementById('message').innerHTML = "";
//     }
    
//     reader.readAsDataURL(input.files[0]);
//   }
// }

// function verifyAndSubmit(){
//     if (document.getElementById('imgContainer').value != ""){
//         document.getElementById('imgPic').submit();
//     }
//     else {
//         alert("No Image Selected.");
//     }
// }
// $("#imgprv").change(function() {
//   document.getElementById('buttonChange').removeAttribute("disabled");
//   readURL(this);
// });
</script>
<?php
include('../layout/footer.php');
?>