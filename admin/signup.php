<?php
require_once('../class/User.php');

if (isset($_POST['submit'])) {

	$Username = $_POST['Username'];
	$password = $_POST['password'];
	$result = $user->register($Username, $password);
	if ($result) {
		header('Location: /stadium');
	}
}
$user->Disconnect();

?>

<?php include('/stadium/partials/header.php'); ?>

<?php include('/stadium/partials/nav.php'); ?>

<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title" style="font-size: 35px; margin-left:140px; color:orangered">Create Account Here</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="un">Username:</label>
					<div class="col-sm-10">
						<input type="text" name="Username" class="form-control" id="un" placeholder="Enter Username" autofocus="" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Password:</label>
					<div class="col-sm-10">
						<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="cpwd">Confirm Password: </label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="cpwd" placeholder="Enter password" required="">
						<br>
						<span class="text-danger" id="match"></span>

					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" id="submit-btn" class="btn btn-default" name="submit">Sign Up
							<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-3"></div>


<?php require_once('modal/message.php'); ?>

<script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).on('submit', '#form-login', function(event) {
		event.preventDefault();
		/* Act on the event */
		// console.log('test');
		var un = $('#un').val();
		var pwd = $('#pwd').val();

		$.ajax({
			url: '../data/login.php',
			type: 'post',
			dataType: 'json',
			data: {
				un: "admin",
				pwd: "admin"
			},
			success: function(data) {
				console.log(data);
				if (data.valid == true) {
					window.location = data.url;
				} else {
					$('#modal-message').find('#body-cont').text(data.msg);
					$('#modal-message').modal('show');
					$('#un').val("");
					$('#pwd').val("");
					$('#un').focus();
				}
			},
			error: function() {
				alert('Error: L99+');
			} //
		});
	});
	document.getElementById('cpwd').addEventListener('keyup', e => {
		const cPassword = e.currentTarget.value
		passwordMatch = cPassword === document.getElementById('pwd').value
		document.getElementById('submit-btn').disabled = !passwordMatch
		if (!passwordMatch) {
			document.getElementById('match').textContent = 'password doesn\'t match'
		} else {

			document.getElementById('match').textContent = ''
		}
	})
</script>

</body>

</html>