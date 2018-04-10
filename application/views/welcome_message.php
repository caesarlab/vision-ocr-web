<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-4.1.0-dist/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

		<title>Google Vision - OCR</title>
	</head>
	<body>
		<div class="container-fluid">
			<h1 class="display-4">Optical character recognition (OCR)</h1>
			<form class="form-inline" enctype="multipart/form-data" method="post">
				<div class="form-group mb-2">
					<label for="image" class="sr-only">Image</label>
					<input type="file" readonly class="form-control-plaintext" id="image" name="image">
				</div>
				<button type="submit" class="btn btn-sm btn-primary mb-2">Submit</button>
			</form>
			<div class="card card-body bg-light">
                
            </div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="<?php echo base_url(); ?>assets/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/popper.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/bootstrap-4.1.0-dist/js/bootstrap.min.js"></script>
		<script>
			$( document ).ready(function() {
				$('body').on('submit','form',function() {
					selector = $(this);
					selector.children('button').text('Loading...').attr('disabled','disabled');
					$.ajax({
						url: '<?php echo site_url('welcome/ocr'); ?>',
						type: 'POST',
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData:false,  
						success: function (data) {
							$('.card').html(data);
							selector.children('button').text('Submit').removeAttr('disabled');
						}
					});
					return false;
				});	
			});
		</script>
	</body>
</html>