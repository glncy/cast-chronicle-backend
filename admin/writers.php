<?php

$section = "admin-panel";
$pageSection = "writers";

include('../functions.php');
include('process/auth.php');

// HEADER
include('../layout/header.php');
?>

<div class="row" style="height:100vh;">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-labelledby="changeImageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeImageModalLabel">Change Writer Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="process/change_image.php" method="POST" id="imgPic">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-8">
                    <span>Image size must be 250x250 pixels</span>
                    <br/>
                    <label>Choose Image</label>
                    <input type="file" name="image" id="imgprv">
                    <input type="hidden" name="imgb64" id="imgContainer">
                    <input type="hidden" name="writer_id" id="writer_id">
                    <br/>
                </div>
                <div class="col-sm-4">
                    <div id="message"></div>
                    <img id="imgOut" class="img-fluid"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="verifyAndSubmit();" disabled id="buttonChange" disabled>Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
include('../layout/footer.php');
?>