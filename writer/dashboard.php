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
                                <div class="button-group">
                                    <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">Select&nbsp&nbsp<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="listCat" data-value="news" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;News</a></li>
                                        <li><a href="#" class="listCat" data-value="devcomm" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Devcomm</a></li>
                                        <li><a href="#" class="listCat" data-value="feature" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Feature</a></li>
                                        <li><a href="#" class="listCat" data-value="sports" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Sports</a></li>
                                        <li><a href="#" class="listCat" data-value="editorial" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Editorial</a></li>
                                        <li><a href="#" class="listCat" data-value="opinion" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Opinion</a></li>
                                        <li><a href="#" class="listCat" data-value="literary" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Literary</a></li>
                                        <li><a href="#" class="listCat" data-value="photojourn" tabIndex="-1" style="margin-left: 10px;"><input type="checkbox"/>&nbsp;Photo Journalism</a></li>
                                    </ul>
                                </div>
                            <!-- <select id="category" class="form-control">
                                <option disabled selected value="">Select Category</option>
                                <option value="news">News</option>
                                <option value="devcomm">Devcomm</option>
                                <option value="feature">Feature</option>
                                <option value="sports">Sports</option>
                                <option value="editorial">Editorial</option>
                                <option value="opinion">Opinion</option>
                                <option value="literary">Literary</option>
                                <option value="photojourn">Photo Journalism</option>
                            </select> -->
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