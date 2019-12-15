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
	?>
	<script>
	window.onload = date_time('date_time');

	function date_time(id)
	{
		date = new Date;
		year = date.getFullYear();
		month = date.getMonth();
		months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
		d = date.getDate();
		day = date.getDay();
		days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		h = date.getHours();
		if(h<10)
		{
				h = "0"+h;
		}
		m = date.getMinutes();
		if(m<10)
		{
				m = "0"+m;
		}
		s = date.getSeconds();
		if(s<10)
		{
				s = "0"+s;
		}
		//result = ''+days[day]+' '+months[month]+' '+d+', '+year+' '+h+':'+m+':'+s;
		result = ''+days[day]+' '+months[month]+' '+d+', '+year+' '+DisplayCurrentTime();;
		document.getElementById(id).innerHTML = result;
		setTimeout('date_time("'+id+'");','1000');
		return true;
	}

	function DisplayCurrentTime() {
        var date = new Date();
        var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
        var am_pm = date.getHours() >= 12 ? "PM" : "AM";
        hours = hours < 10 ? "0" + hours : hours;
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds + " " + am_pm;
        return time;
    };

	</script>
	<?php
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
					[ 'direction', { 'align': [] }]
				]
			}
		});
		
		var options = [];

		$( '.dropdown-menu .listCat' ).on( 'click', function( event ) {
			var $target = $( event.currentTarget ),
				val = $target.attr( 'data-value' ),
				$inp = $target.find( 'input' ),
				idx;

			if ( ( idx = options.indexOf( val ) ) > -1 ) {
				options.splice( idx, 1 );
				setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
			} else {
				options.push( val );
				setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
			}

			$( event.target ).blur();
				
			console.log( options );
			return false;
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
			var optLength = options.length;
			if ((document.getElementById("article_title").value != "")&&(optLength != 0)) {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					img: getImage(),
					status: "draft",
					category: JSON.stringify(options)
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
				else if (optLength == 0){
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
					[ 'direction', { 'align': [] }]
				]
			}
		});

		var options = <?php echo $obj[0]['category'];?>;

		$( '.dropdown-menu .listCat' ).on( 'click', function( event ) {
			var $target = $( event.currentTarget ),
				val = $target.attr( 'data-value' ),
				$inp = $target.find( 'input' ),
				idx;

			if ( ( idx = options.indexOf( val ) ) > -1 ) {
				options.splice( idx, 1 );
				setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
			} else {
				options.push( val );
				setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
			}

			$( event.target ).blur();
				
			console.log( options );
			return false;
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

		function confirmDelete(){
			Swal.fire({
				title: 'Are you sure?',
				text: "Your document will be deleted",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.value) {
					submitAsDelete();
				}
			});
		}

		function submitAsDraft(){
			var ifSubmitted = false;
			var message = "";
			var optLength = options.length;
			if ((document.getElementById("article_title").value != "")&&(optLength != 0)) {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					img: getImage(),
					status: "draft",
					category: JSON.stringify(options),
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
		function submitAsDelete(){
			var ifSubmitted = false;
			var message = "";
			var delta = quill.getContents();
			var data = {
				access_token: "<?php echo $_COOKIE['access_token']; ?>",
				article_id: "<?php echo $obj[0]['id']; ?>"
			}

			$.ajax({
				url: "<?php echo baseURL(); ?>api/article.php",
				type: "delete",
				data: data,
				beforeSend: function(){
					Swal.fire({
  						icon: 'warning',
  						title: 'Deleting Article...',
  						showConfirmButton: false,
					})
				},
				success: function(r){
					var str = JSON.stringify(r);
					var obj = JSON.parse(str);

					if (obj.status == "success_delete") {
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
							window.location.href = "articles.php";
						}, 2000);	
					}
					else {
						setTimeout(function(){
							Swal.fire(
								message,
								'',
								'warning'
							)
						}, 2000);
					}
				}
			});
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
			var optLength = options.length;
			if ((document.getElementById("article_title").value != "")&&(optLength != 0)) {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					img: getImage(),
					status: "pending",
					category: JSON.stringify(options),
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
			var optLength = options.length;
			if ((document.getElementById("article_title").value != "")&&(optLength != 0)) {
				var delta = quill.getContents();
				var data = {
					access_token: "<?php echo $_COOKIE['access_token']; ?>",
					title: document.getElementById("article_title").value,
					body: quillGetHTML(delta),
					status: "draft",
					img: getImage(),
					category: JSON.stringify(options),
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
	?>
	
	<script>
	window.onload = date_time('date_time');
	
	function date_time(id)
	{
		date = new Date;
		year = date.getFullYear();
		month = date.getMonth();
		months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
		d = date.getDate();
		day = date.getDay();
		days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		h = date.getHours();
		if(h<10)
		{
				h = "0"+h;
		}
		m = date.getMinutes();
		if(m<10)
		{
				m = "0"+m;
		}
		s = date.getSeconds();
		if(s<10)
		{
				s = "0"+s;
		}
		result = ''+days[day]+' '+months[month]+' '+d+', '+year+' '+DisplayCurrentTime();
		document.getElementById(id).innerHTML = result;
		setTimeout('date_time("'+id+'");','1000');
		return true;
	}

	function DisplayCurrentTime() {
        var date = new Date();
        var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
        var am_pm = date.getHours() >= 12 ? "PM" : "AM";
        hours = hours < 10 ? "0" + hours : hours;
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds + " " + am_pm;
        return time;
    };
	</script>
	<?php
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
	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script>
	window.onload = getRemarks();

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
				[ 'direction', { 'align': [] }]
			]
		}
	});

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
			text: "This will be Copyread by Writer.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {
			if (result.value) {
				submitAsReject("rejected");
			}
		});
	}

	function setRejectCopyreader(){
		Swal.fire({
			title: 'Are you sure?',
			text: "This will be Copyread by Copyreader.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {
			if (result.value) {
				submitAsReject("copyread");
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

	function submitAsReject(copyreadStatus){	
		var ifSubmitted = false;
		var message = "";

		var data = {
			access_token: "<?php echo $_COOKIE['access_token']; ?>",
			title: "<?php echo $conn->real_escape_string($obj[0]['title']); ?>",
			body: quillGetHTML(quill.getContents()),
			status: copyreadStatus,
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
			body: quillGetHTML(quill.getContents()),
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
			body: quillGetHTML(quill.getContents()),
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

	function quillGetHTML(inputDelta) {
		var tempCont = document.createElement("div");
		(new Quill(tempCont)).setContents(inputDelta);
		return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
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
								return '<center><button class="btn btn-danger btn-sm" onclick="change_role(\''+row.id+'\',\'student\')">Disable Writer</button>&nbsp&nbsp<button class="btn btn-success btn-sm" onclick="change_profile(\''+row.id+'\');" type="button" data-toggle="modal" data-target="#changeImageModal"">Change Picture</button></center>';
							}
							else {
								return '<center><button class="btn btn-info btn-sm" onclick="change_role(\''+row.id+'\',\'writer\')">Enable Writer</button></center>';
							}
						}
					}
				]
			});
		});

		function change_role(id,role) {
			window.location.href = "<?= baseURL(); ?>admin/process/change_role.php?id="+id+"&role="+role;
		}

		function change_profile(id) {
			document.getElementById("writer_id").value = id;
			$.ajax({
				url: "<?= baseURL(); ?>api/user.php",
				type: "GET",
				data: {
					user_id: id
				},
				success: function(response){
					if (response[0].img != ""){
						$('#imgOut').attr('src', response[0].img);
					}
					else {
						document.getElementById("message").innerHTML = "No Image Found"
					}
				}
			});
		}

		function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			$('#imgOut').attr('src', e.target.result);
			document.getElementById('imgContainer').value = e.target.result;
			document.getElementById('message').innerHTML = "";
			}
			
			reader.readAsDataURL(input.files[0]);
		}
		}

		function verifyAndSubmit(){
			if (document.getElementById('imgContainer').value != ""){
				document.getElementById('imgPic').submit();
			}
			else {
				alert("No Image Selected.");
			}
		}

		$("#imgprv").change(function() {
		document.getElementById('buttonChange').removeAttribute("disabled");
		readURL(this);
		});
	</script>
	<?php
				}
				elseif ($pageSection == 'about'){
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
					[ 'direction', { 'align': [] }]
				]
			}
		});

		function quillGetHTML(inputDelta) {
			var tempCont = document.createElement("div");
			(new Quill(tempCont)).setContents(inputDelta);
			return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
		}

		function saveAbout(){
			var delta = quill.getContents();
			document.getElementById('aboutData').value = quillGetHTML(delta);
			document.getElementById('aboutForm').submit();
		}
	</script>
	<?php
				}
				elseif ($pageSection == 'home'){
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
					[ 'direction', { 'align': [] }]
				]
			}
		});

		function quillGetHTML(inputDelta) {
			var tempCont = document.createElement("div");
			(new Quill(tempCont)).setContents(inputDelta);
			return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
		}

		function saveHome(){
			var delta = quill.getContents();
			document.getElementById('homeData').value = quillGetHTML(delta);
			document.getElementById('homeForm').submit();
		}
	</script>
	<?php
				}
			}
		}
		elseif ($section=="copyreader-panel") {
	?>
	
	<script>
	window.onload = date_time('date_time');
	
	function date_time(id)
	{
		date = new Date;
		year = date.getFullYear();
		month = date.getMonth();
		months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
		d = date.getDate();
		day = date.getDay();
		days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		h = date.getHours();
		if(h<10)
		{
				h = "0"+h;
		}
		m = date.getMinutes();
		if(m<10)
		{
				m = "0"+m;
		}
		s = date.getSeconds();
		if(s<10)
		{
				s = "0"+s;
		}
		result = ''+days[day]+' '+months[month]+' '+d+', '+year+' '+DisplayCurrentTime();
		document.getElementById(id).innerHTML = result;
		setTimeout('date_time("'+id+'");','1000');
		return true;
	}

	function DisplayCurrentTime() {
        var date = new Date();
        var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
        var am_pm = date.getHours() >= 12 ? "PM" : "AM";
        hours = hours < 10 ? "0" + hours : hours;
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds + " " + am_pm;
        return time;
    };
	</script>
	<?php
			if (isset($pageSection)){
				if ($pageSection == "articles"){
	?>
	<script>
		function openLink(id){
			window.location.href = "<?php echo baseURL();?>copyreader/edit.php?id="+id;
		}
	</script>
	<?php
				}
				elseif ($pageSection == "edit"){
	?>
	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script>
	window.onload = getRemarks();

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
				[ 'direction', { 'align': [] }]
			]
		}
	});

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
						displayRemarks += "<li>"+obj[loop].body+"</li>";
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

	function setCopyread(){
		Swal.fire({
			title: 'Are you sure?',
			text: "Changes will be sent to Admin.",
			type: 'question',
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


	function submitAsApproved(){
		var ifSubmitted = false;
		var message = "";

		var data = {
			access_token: "<?php echo $_COOKIE['access_token']; ?>",
			title: "<?php echo $conn->real_escape_string($obj[0]['title']); ?>",
			body: quillGetHTML(quill.getContents()),
			status: "pending",
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
						window.location.href = "<?php echo baseURL();?>copyreader/articles.php";
					}, 2000);	
				}
				else {
					setTimeout(function(){
						Swal.fire(
							message,
							'',
							'warning'
						)
						document.getElementById('approveButton').innerHTML = "Submit";
						document.getElementById('approveButton').removeAttribute("disabled");
						window.location.href = "<?php echo baseURL();?>copyreader/edit.php?id=<?php echo $obj[0]['id']; ?>";
					}, 2000);
				}
			}
		});
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