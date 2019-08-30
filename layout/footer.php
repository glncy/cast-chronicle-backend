		<div>
	</section>
	<script type="text/javascript" src="<?= baseURL(); ?>js/jquery-3.3.1.min.js"></script>
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

		function confirmSubmit(){
			var ifSubmitted = false;
			var message = "";
			if (document.getElementById("article_title").value != "") {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					status: "draft",
					category: ""
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
				Swal.fire(
					'Uh oh!',
					'It has Empty Title!',
					'warning'
				)
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

		function confirmSubmit(){
			var ifSubmitted = false;
			var message = "";
			if (document.getElementById("article_title").value != "") {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					status: "draft",
					category: ""
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
				Swal.fire(
					'Uh oh!',
					'It has Empty Title!',
					'warning'
				)
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
			}
		}
	}
	?>
</body>
</html>