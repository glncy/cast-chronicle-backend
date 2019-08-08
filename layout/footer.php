		<div>
	</section>
	<script type="text/javascript" src="<?= baseURL(); ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?= baseURL(); ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?= baseURL(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= baseURL(); ?>js/aos.js"></script>
	<script type="text/javascript" src="<?= baseURL(); ?>js/platform.js"></script>
	<script>
		AOS.init();
	</script>
	<?php
	if (isset($section)) {
		if ($section=="writers-panel") {
	?>
	<script type="text/javascript" src="<?= baseURL(); ?>js/ckeditor.js"></script>
	<script>
		ClassicEditor
			.create( document.querySelector( '#editor' ), {
				// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
				ckfinder: {
					uploadUrl: '<?= baseURL(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
				}
			} )
			.then( editor => {
				window.editor = editor;
			} )
			.catch( err => {
				console.error( err.stack );
			} );
	</script>
	<?php
		}
	}
	?>
	<script>
		document.querySelectorAll( 'oembed[url]' ).forEach( element => {
			// Create the <a href="..." class="embedly-card"></a> element that Embedly uses
			// to discover the media.
			const anchor = document.createElement( 'a' );

			anchor.setAttribute( 'href', element.getAttribute( 'url' ) );
			anchor.className = 'embedly-card';

			element.appendChild( anchor );
		} );
	</script>
</body>
</html>