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
			document.getElementById('submitButton').innerHTML = "Saving Draft...";
			document.getElementById('test').innerHTML = quill.root.innerHTML;
			var delta = quill.getContents();
			//console.log(quill.root.innerHTML);
			console.log(quillGetHTML(delta));
			document.getElementById('submitButton').setAttribute("disabled","");
			console.log("test");
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
	?>
</body>
</html>