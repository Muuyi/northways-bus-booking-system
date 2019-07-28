<?php
	require_once("header.php");
?>
<?php
	if(isset($_POST['submit'])){
		$user = mysqli_real_escape_string($con, $_POST['email']);
		$pass = mysqli_real_escape_string($con, $_POST['password']);
		$q = "SELECT * FROM admins WHERE admin_email='$user' AND admin_password='$pass' AND org_id=6";
		$rQ = mysqli_query($con, $q);
		$count = mysqli_num_rows($rQ);
		if($count > 0){
			$row = mysqli_fetch_array($rQ);
			$_SESSION['username'] = $row['admin_email'];
			$_SESSION['admin'] = $row['admin_type'];
			$_SESSION['company'] = $row['org_id'];
			$_SESSION['fname'] = $row['admin_fname'];
			header("location:../travmate/admins/admin.php");
		}else{
			echo "<script>alert('Username or email is wrong!Please confirm to ensure that you have entered the correct values!')</script>";
		}
	}
?>
<br />
<form method="POST" action="login.php">
	<fieldset>
		<legend>Sign in</legend>
		<div class="form-group">
			<label for="username">Email address</label>
			<input type="email" name="email" class="form-control" placeholder="Please enter your email" />
		</div>
		<div class="form-group">
			<label for="username">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Please enter your password" />
		</div>
		<button type="submit" name="submit" class="btn btn-primary" >Log in</button>

	</fieldset>
</form>