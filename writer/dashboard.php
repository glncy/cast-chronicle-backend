<?php
include('process/auth.php');

$section = "writers-panel";

$pageSection = "dashboard";

include('../functions.php');

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
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="article_title">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select id="category" class="form-control">
                                <option disabled selected>Select Category</option>
                                <option>Test</option>
                            </select>
                        </div>
                    </div>
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