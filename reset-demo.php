<p id="mensaje"></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	$.ajax({
		url: 'http://demo.residenciasonline.com/reset',
		type: 'GET',
	})
	.done(function() {
		console.log("success");
		$('#mensaje').html("Listo");
	})
	.fail(function() {
		console.log("error");
		$('#mensaje').html("Error");
	})
	.always(function() {
		console.log("complete");
	});
</script>