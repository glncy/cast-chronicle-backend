		<div>
	</section>
	<script type="text/javascript" src="<?= baseURL(); ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?= baseURL(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= baseURL(); ?>js/aos.js"></script>
	<script>
		AOS.init();
	</script>
	<?php
	if (isset($section)) {
		if ($section=="writers-panel") {
			if (isset($pageSection)){
				if ($pageSection == "dashboard"){
	?>
	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

	<!-- Initialize Quill editor -->
	<script>
		var quill = new Quill('#editor', {
			theme: 'snow',
			modules: {
					'toolbar': [
					[{ 'font': [] }, { 'size': [] }],
					[ 'bold', 'italic', 'underline', 'strike' ],
					[{ 'color': [] }, { 'background': [] }],
					[{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
					[{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
					[ 'link', 'image', 'video'],
				]
			}
		});

		function getImage(){
			var someimage = document.getElementById('editor');
			var myimg = someimage.getElementsByTagName('img')[0];
			if (typeof myimg === "undefined") {
				return "";
			} else {
				return myimg.src;
			}
		}

		function confirmSubmit(){
			var ifSubmitted = false;
			var message = "";
			if ((document.getElementById("article_title").value != "")&&(document.getElementById("category").value != "")) {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					img: getImage(),
					status: "draft",
					category: document.getElementById("category").value
				}

				$.ajax({
					url: "<?php echo baseURL(); ?>api/article.php",
					type: "post",
					data: data,
					beforeSend: function(){
						document.getElementById('submitButton').innerHTML = "Saving Draft...";
						document.getElementById('submitButton').setAttribute("disabled","");
					},
					success: function(r){
						var str = JSON.stringify(r);
                    	var obj = JSON.parse(str);

						if (obj.status == "success_add") {
							ifSubmitted = true;
							message = obj.message;
						}
						else {
							message = obj.message;
						}					
					},
					complete: function(){
						if (ifSubmitted) {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'success'
								)
								document.getElementById('submitButton').innerHTML = "Save Draft";
								document.getElementById('submitButton').removeAttribute("disabled");
								window.location.href = "<?php echo baseURL(); ?>writer/articles.php";
							}, 2000);	
						}
						else {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'warning'
								)
								document.getElementById('submitButton').innerHTML = "Save";
								document.getElementById('submitButton').removeAttribute("disabled");
							}, 2000);
						}
					}
				});	
			}
			else {
				if (document.getElementById("article_title").value == ""){
					Swal.fire(
						'Uh oh!',
						'It has Empty Title!',
						'warning'
					)
				}
				else if (document.getElementById("category").value == ""){
					Swal.fire(
						'Uh oh!',
						'It has Empty Category!',
						'warning'
					)
				}
				else {
					Swal.fire(
						'Uh oh!',
						'It has Empty Title and Category!',
						'warning'
					)
				}
				
			}
		}

		function quillGetHTML(inputDelta) {
			var tempCont = document.createElement("div");
			(new Quill(tempCont)).setContents(inputDelta);
			return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
		}
	</script>
	<?php
				}
				else if ($pageSection == "articles"){
	?>
	<script>
		function openLink(id){
			window.location.href = "<?php echo baseURL();?>writer/edit.php?id="+id;
		}
	</script>
	<?php
				}
				else if ($pageSection == "edit"){
	?>
	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

	<!-- Initialize Quill editor -->
	<script>
		var quill = new Quill('#editor', {
			theme: 'snow',
			modules: {
					'toolbar': [
					[{ 'font': [] }, { 'size': [] }],
					[ 'bold', 'italic', 'underline', 'strike' ],
					[{ 'color': [] }, { 'background': [] }],
					[{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
					[{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
					[ 'link', 'image', 'video'],
				]
			}
		});

		// var quillBody = quillGetHTML(quill.getContents());
		// var quillTitle = document.getElementById("article_title").value;
		<?php
			if (($obj[0]['status']=="draft")||($obj[0]['status']=="pending")||($obj[0]['status']=="rejected")){
		?>
		var articleStatus = "<?php echo $obj[0]['status']; ?>";
		function confirmSubmit(){
			if (articleStatus == "pending") {
				Swal.fire({
					title: 'Are you sure?',
					text: "Your document will be turn into Draft",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, save it!'
					}).then((result) => {
					if (result.value) {
						submitAsDraft();
					}
				});
			}
			else {
				submitAsDraft();
			}
		}

		function submitAsDraft(){
			var ifSubmitted = false;
			var message = "";
			if (document.getElementById("article_title").value != "") {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					img: getImage(),
					status: "draft",
					category: document.getElementById("category").value,
					article_id: "<?php echo $obj[0]['id']; ?>"
				}

				$.ajax({
					url: "<?php echo baseURL(); ?>api/article.php",
					type: "put",
					data: data,
					beforeSend: function(){
						document.getElementById('submitButton').innerHTML = "Saving Draft...";
						document.getElementById('submitButton').setAttribute("disabled","");
						document.getElementById('approvalButton').setAttribute("disabled","");
					},
					success: function(r){
						var str = JSON.stringify(r);
						var obj = JSON.parse(str);

						if (obj.status == "success_update") {
							ifSubmitted = true;
							message = obj.message;
						}
						else {
							message = obj.message;
						}					
					},
					complete: function(){
						if (ifSubmitted) {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'success'
								)
								document.getElementById('submitButton').innerHTML = "Save Draft";
								document.getElementById('approvalButton').innerHTML = "Submit for Approval";
								document.getElementById('submitButton').removeAttribute("disabled");
								document.getElementById('approvalButton').removeAttribute("disabled");
								articleStatus = "draft";
							}, 2000);	
						}
						else {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'warning'
								)
								document.getElementById('submitButton').innerHTML = "Save Draft";
								document.getElementById('submitButton').removeAttribute("disabled");
								document.getElementById('approvalButton').removeAttribute("disabled");

							}, 2000);
						}
					}
				});	
			}
			else {
				Swal.fire(
					'Uh oh!',
					'It has Empty Title!',
					'warning'
				)
			}
		}

		function setForApproval(){
			if (articleStatus == "draft"){
				Swal.fire({
					title: 'Are you ready?',
					text: "Your article be under review once submitted.",
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, submit it!'
					}).then((result) => {
						submitAsForApproval();
				});
			}
			else {
				submitAsForApproval()
			}
		}

		function submitAsForApproval(){
			var ifSubmitted = false;
			var message = "";
			if (document.getElementById("article_title").value != "") {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					img: getImage(),
					status: "pending",
					category: document.getElementById("category").value,
					article_id: "<?php echo $obj[0]['id']; ?>"
				}

				$.ajax({
					url: "<?php echo baseURL(); ?>api/article.php",
					type: "put",
					data: data,
					beforeSend: function(){
						if (document.getElementById('approvalButton').innerHTML == "Update"){
							document.getElementById('approvalButton').innerHTML = "Updating...";
							document.getElementById('submitButton').setAttribute("disabled","");
							document.getElementById('approvalButton').setAttribute("disabled","");
						}
						else {
							document.getElementById('approvalButton').innerHTML = "Updating for Approval...";
							document.getElementById('approvalButton').setAttribute("disabled","");
							document.getElementById('submitButton').setAttribute("disabled","");
						}
					},
					success: function(r){
						var str = JSON.stringify(r);
						var obj = JSON.parse(str);

						if (obj.status == "success_update") {
							ifSubmitted = true;
							message = obj.message;
						}
						else {
							message = obj.message;
						}					
					},
					complete: function(){
						if (ifSubmitted) {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'success'
								)
								document.getElementById('approvalButton').innerHTML = "Update";
								document.getElementById('approvalButton').removeAttribute("disabled");
								document.getElementById('submitButton').removeAttribute("disabled");
								articleStatus = "pending";
							}, 2000);	
						}
						else {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'warning'
								)
								document.getElementById('approvalButton').innerHTML = "Submit for Approval";
								document.getElementById('approvalButton').removeAttribute("disabled");
								document.getElementById('submitButton').removeAttribute("disabled");
							}, 2000);
						}
					}
				});	
			}
			else {
				Swal.fire(
					'Uh oh!',
					'It has Empty Title!',
					'warning'
				)
			}
		}

		function getImage(){
			var someimage = document.getElementById('editor');
			var myimg = someimage.getElementsByTagName('img')[0];
			if (typeof myimg === "undefined") {
				return "";
			} else {
				return myimg.src;
			}
		}

		<?php
			}
			elseif ($obj[0]['status']=="published"){
		?>

		function getImage(){
			var someimage = document.getElementById('editor');
			var myimg = someimage.getElementsByTagName('img')[0];
			if (typeof myimg === "undefined") {
				return "";
			} else {
				return myimg.src;
			}
		}

		function confirmSubmit(){
			Swal.fire({
				title: 'Are you sure?',
				text: "Your document will be turn into Draft and it should be reviewed again.",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, save it!'
				}).then((result) => {
				if (result.value) {
					submitAsDraft();
				}
			});
		}

		function submitAsDraft(){
			var ifSubmitted = false;
			var message = "";
			if (document.getElementById("article_title").value != "") {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					status: "draft",
					img: getImage(),
					category: document.getElementById("category").value,
					article_id: "<?php echo $obj[0]['id']; ?>"
				}

				$.ajax({
					url: "<?php echo baseURL(); ?>api/article.php",
					type: "put",
					data: data,
					beforeSend: function(){
						document.getElementById('submitButton').innerHTML = "Saving Draft...";
						document.getElementById('submitButton').setAttribute("disabled","");
					},
					success: function(r){
						var str = JSON.stringify(r);
						var obj = JSON.parse(str);

						if (obj.status == "success_update") {
							ifSubmitted = true;
							message = obj.message;
						}
						else {
							message = obj.message;
						}					
					},
					complete: function(){
						if (ifSubmitted) {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'success'
								)
								window.location.href = "<?php echo baseURL(); ?>writer/edit.php?id=<?php echo $obj[0]['id']; ?>";
							}, 2000);	
						}
						else {
							setTimeout(function(){
								Swal.fire(
									message,
									'',
									'warning'
								)
								document.getElementById('submitButton').innerHTML = "Save Draft";
								document.getElementById('submitButton').removeAttribute("disabled");

							}, 2000);
						}
					}
				});	
			}
			else {
				Swal.fire(
					'Uh oh!',
					'It has Empty Title!',
					'warning'
				)
			}
		}

		<?php
			}
		?>

		function quillGetHTML(inputDelta) {
			var tempCont = document.createElement("div");
			(new Quill(tempCont)).setContents(inputDelta);
			return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
		}

	</script>
	<?php
				}
			}
		}
		elseif ($section=="admin-panel") {
			if (isset($pageSection)){
				if ($pageSection == "articles"){
	?>
	<script>
		function openLink(id){
			window.location.href = "<?php echo baseURL();?>admin/edit.php?id="+id;
		}
	</script>
	<?php
				}
				elseif ($pageSection == "edit"){
	?>
	<script>
	window.onload = getRemarks();

	function deleteRemark(id){
		if(confirm("Delete Remarks?")){
			var data = {
				id: id
			}

			$.ajax({
				url: "<?php echo baseURL(); ?>api/remark.php",
				type: "delete",
				data: data,
				success: function(r){
					var str = JSON.stringify(r);
					var obj = JSON.parse(str);
					if (obj.status == "success_delete"){
						alert("Deleted Remarks!");
						getRemarks();
					}
					else {
						alert("Server Error!");
					}
				}
			});
		}
		else {
			alert("Cancelled.");
		}
	}

	function addRemarks() {
		if (document.getElementById('remarksBody').value != ""){
			var data = {
				article_id: "<?php echo $obj[0]['id']; ?>",
				remarks: document.getElementById('remarksBody').value
			}

			$.ajax({
				url: "<?php echo baseURL(); ?>api/remark.php",
				type: "post",
				data: data,
				success: function(r){
					var str = JSON.stringify(r);
					var obj = JSON.parse(str);
					if (obj.status == "success_add"){
						alert("Added Remarks!");
						getRemarks();
					}
					else {
						alert("Server Error!");
					}
				}
			});
		}
		else {
			alert("Please Insert Remarks.");
		}
	}

	function getRemarks() {
		var data = {
			article_id: "<?php echo $obj[0]['id']; ?>"
		}

		$.ajax({
			url: "<?php echo baseURL(); ?>api/remark.php",
			type: "get",
			data: data,
			success: function(r){
				var str = JSON.stringify(r);
				var obj = JSON.parse(str);
				if (typeof obj[0].status === "undefined") {
					var displayRemarks = "";
					var loopCnt = obj.length;
					var loop = 0;
					displayRemarks = "<ol>"
					while (loop < loopCnt) {
						displayRemarks += "<li>"+obj[loop].body+" <button type=\"button\"class=\"btn btn-sm btn-danger\" onclick=\"deleteRemark("+obj[loop].id+")\">REMOVE</button></li>";
						loop++;
					}
					displayRemarks += "</ol>";
					document.getElementById('showRemarks').innerHTML = displayRemarks;
				}
				else {
					document.getElementById('showRemarks').innerHTML = "No Remarks";
				}
			}
		});
	}

	function setReject(){
		Swal.fire({
			title: 'Are you sure?',
			text: "This will be set as Copyread.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {
			if (result.value) {
				submitAsReject();
			}
		});
	}

	function setPublish(){
		Swal.fire({
			title: 'Are you sure?',
			text: "This will be set as Approve and it will be Live.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {
			if (result.value) {
				submitAsApproved();
			}
		});
	}

	function setUnpublish(){
		Swal.fire({
			title: 'Are you sure?',
			text: "This will be set as Unpublished and it will be mark as Pending.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {
			if (result.value) {
				submitAsUnpublish();
			}
		});
	}

	function submitAsReject(){	
		var ifSubmitted = false;
		var message = "";

		var data = {
			access_token: "<?php echo $_COOKIE['access_token']; ?>",
			title: "<?php echo $conn->real_escape_string($obj[0]['title']); ?>",
			body: "<?php echo $conn->real_escape_string($obj[0]['body']); ?>",
			status: "rejected",
			category: "<?php echo $obj[0]['category']; ?>",
			article_id: "<?php echo $obj[0]['id']; ?>"
		}

		$.ajax({
			url: "<?php echo baseURL(); ?>api/article.php",
			type: "put",
			data: data,
			beforeSend: function(){
				document.getElementById('rejectButton').innerHTML = "Setting It...";
				document.getElementById('approveButton').setAttribute("disabled","");
				document.getElementById('rejectButton').setAttribute("disabled","");
			},
			success: function(r){
				var str = JSON.stringify(r);
				var obj = JSON.parse(str);

				if (obj.status == "success_update") {
					ifSubmitted = true;
					message = obj.message;
				}
				else {
					message = obj.message;
				}					
			},
			complete: function(){
				if (ifSubmitted) {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'success'
						)
						document.getElementById('rejectButton').innerHTML = "Copyread";
						document.getElementById('rejectButton').removeAttribute("disabled");
						document.getElementById('approveButton').removeAttribute("disabled");
						
					}, 2000);	
				}
				else {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'warning'
						)
						document.getElementById('rejectButton').innerHTML = "Reject";
						document.getElementById('rejectButton').removeAttribute("disabled");
						document.getElementById('approveButton').removeAttribute("disabled");
					}, 2000);
				}
			}
		});
	}

	function submitAsApproved(){
		var ifSubmitted = false;
		var message = "";

		var data = {
			access_token: "<?php echo $_COOKIE['access_token']; ?>",
			title: "<?php echo $conn->real_escape_string($obj[0]['title']); ?>",
			body: "<?php echo $conn->real_escape_string($obj[0]['body']); ?>",
			status: "published",
			category: "<?php echo $obj[0]['category']; ?>",
			article_id: "<?php echo $obj[0]['id']; ?>"
		}

		$.ajax({
			url: "<?php echo baseURL(); ?>api/article.php",
			type: "put",
			data: data,
			beforeSend: function(){
				document.getElementById('approveButton').innerHTML = "Setting It...";
				document.getElementById('approveButton').setAttribute("disabled","");
				document.getElementById('rejectButton').setAttribute("disabled","");
			},
			success: function(r){
				var str = JSON.stringify(r);
				var obj = JSON.parse(str);

				if (obj.status == "success_update") {
					ifSubmitted = true;
					message = obj.message;
				}
				else {
					message = obj.message;
				}					
			},
			complete: function(){
				if (ifSubmitted) {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'success'
						)
						document.getElementById('approveButton').innerHTML = "Approve and Publish";
						document.getElementById('rejectButton').removeAttribute("disabled");
						document.getElementById('approveButton').removeAttribute("disabled");
						window.location.href = "<?php echo baseURL();?>admin/edit.php?id=<?php echo $obj[0]['id']; ?>";
					}, 2000);	
				}
				else {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'warning'
						)
						document.getElementById('approveButton').innerHTML = "Approve and Publish";
						document.getElementById('rejectButton').removeAttribute("disabled");
						document.getElementById('approveButton').removeAttribute("disabled");
						window.location.href = "<?php echo baseURL();?>admin/edit.php?id=<?php echo $obj[0]['id']; ?>";
					}, 2000);
				}
			}
		});
	}

	function submitAsUnpublish(){
		var ifSubmitted = false;
		var message = "";

		var data = {
			access_token: "<?php echo $_COOKIE['access_token']; ?>",
			title: "<?php echo $conn->real_escape_string($obj[0]['title']); ?>",
			body: "<?php echo $conn->real_escape_string($obj[0]['body']); ?>",
			status: "pending",
			category: "<?php echo $obj[0]['category']; ?>",
			article_id: "<?php echo $obj[0]['id']; ?>"
		}

		$.ajax({
			url: "<?php echo baseURL(); ?>api/article.php",
			type: "put",
			data: data,
			beforeSend: function(){
				document.getElementById('unpublishButton').innerHTML = "Setting It...";
				document.getElementById('unpublishButton').setAttribute("disabled","");
			},
			success: function(r){
				var str = JSON.stringify(r);
				var obj = JSON.parse(str);

				if (obj.status == "success_update") {
					ifSubmitted = true;
					message = obj.message;
				}
				else {
					message = obj.message;
				}					
			},
			complete: function(){
				if (ifSubmitted) {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'success'
						);
						window.location.href = "<?php echo baseURL();?>admin/edit.php?id=<?php echo $obj[0]['id']; ?>";
					}, 2000);	
				}
				else {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'warning'
						);
					}, 2000);
				}
			}
		});
	}
	</script>
	<?php
				}
				elseif ($pageSection == 'writers'){
	?>
	<script type="text/javascript">
		$(window).ready(function(){
			$("#table").DataTable({
				"ajax" : {	
					"url" : "<?= baseURL(); ?>api/user.php",
					"dataSrc": ""
				},
				"columns" : [
					{ data : "studentId"},
					{ data : "fname"},
					{ data : "lname"},
					{ data : "role"},
					{ data : "id" , 
						render : function (data, type, row) {
							if (row.role == "writer") {
								return '<button class="btn btn-danger btn-sm" onclick="change_role(\''+row.id+'\',\'student\')">Disable Writer</button>';
							}
							else {
								return '<button class="btn btn-info btn-sm" onclick="change_role(\''+row.id+'\',\'writer\')">Enable Writer</button>';
							}
						}
					}
				]
			});
		});

		function change_role(id,role) {
			window.location.href = "<?= baseURL(); ?>admin/process/change_role.php?id="+id+"&role="+role;
		}

	</script>
	<?php
				}
			}
		}
	}
	?>
</body>
</html>