<?php
require_once('data/get_matches.php');

// echo '<pre>';
// print_r($origins);
// echo '</pre>';
?>
<?php include('./partials/header.php'); ?>

<body style="background: url('images/night-ground.jpg') center center no-repeat;background-size:cover; background-attachment: fixed;">
	<?php include('./partials/nav.php'); ?>

	<div class="container-fluid">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">STEPS FOR BOOKING</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">1. MATCH
										<span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
									</h3>
								</div>
								<div class="panel-body">
									SCHEDULE OF MATCH
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">2. SEAT SELECTION</h3>
								</div>
								<div class="panel-body">
									SEAT TYPE
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">3. VISITOR INFO</h3>
								</div>
								<div class="panel-body">
									VISITORS DETAILS
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h3 class="panel-title">4. PAYMENT INFO</h3>
								</div>
								<div class="panel-body">
									TOTAL PAYMENT
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="container-fluid">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<h2>
						<center>CHOOSE MATCH</center>
					</h2>
					<div class="container-fluid">
						<form class="form-horizontal" role="form" id="form-itinerary">
							<center>
								<div class="form-group">
									<label for="">Date:</label>
									<input type="date" class="btn btn-default" id="dept-date" required>
								</div>
								<div class="form-group">
									<label for="">Select Match:</label>
									<select class="btn btn-default" id="orig-id" required>
										<?php foreach ($origins as $o) : ?>
											<option value="<?= $o['match_id']; ?>"> <?= $o['match_desc']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>


								<button type="submit" class="btn btn-success">NEXT
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>

	<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).on('submit', '#form-itinerary', function(event) {
			event.preventDefault();
			/* Act on the event */
			var validate = "";
			var origin = $('select[id=orig-id]').val();
			var dept = $('input[id=dept-date]').val();

			if (dept.length == 0) {
				alert('Please Select Departure Date!');
			} else if (origin == 1) {
				alert('Please Select Match');
			} else {
				$.ajax({
					url: 'data/session_itinerary.php',
					type: 'post',
					dataType: 'json',
					data: {
						oid: origin,
						dd: dept
					},
					success: function(data) {
						console.log(data);
						if (data.valid == true) {
							window.location = data.url;
							console.log('sss');
						}
					},
					error: function() {
						alert('Error: L161+');
					}
				});
			} //end dept kung == 0


		});
	</script>

</body>

</html>