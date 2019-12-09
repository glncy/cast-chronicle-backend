<?php
include('process/auth.php');

$section = "writers-panel";

$pageSection = "dashboard";

include('../functions.php');

// HEADER
include('../layout/header.php');
?>

<div class="row justify-content-center">
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
                                <option disabled selected value="">Select Category</option>
                                <option value="news">News</option>
                                <option value="devcomm">Devcomm</option>
                                <option value="feature">Feature</option>
                                <option value="sports">Sports</option>
                                <option value="editorial">Editorial</option>
                                <option value="opinion">Opinion</option>
                                <option value="literary">Literary</option>
                                <option value="photojourn">Photo Journalism</option>
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
</div>
<?php
include('../layout/footer.php');
?>