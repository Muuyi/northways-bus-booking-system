<?php
	require_once("header.php");
?>
	<section class="container-fluid">
		<section class="row">
			<aside class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4>Send us a message</h4>
					</div>
					<div class="card-body">
						<form method="POST" action="contact_us.php">
							<div class="form-group">
								<label for="full_names">Enter full name:</label>
								<input type="text" name="full_names" class="form-control" placeholder="Enter your full names" />
							</div>
							<div class="form-group">
								<label for="full_names">Enter your phone number:</label>
								<input type="number" name="phone" class="form-control" placeholder="Enter your phone number" />
							</div>
							<div class="form-group">
								<label for="full_names">Message:</label>
								<textarea class="form-control" name="message">
								</textarea>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-info form-control" name="send_message" value="Send message" />
							</div>
						</form>
					</div>
				</div>
			</aside>
			<article class="col-md-4" style="text-align:center;">
				<div style="text-align:center;">
					<h4>Main office Contacts</h4>
					<?php
						$qry = "SELECT * FROM organizations WHERE username='northways'";
						$rQry = mysqli_query($con, $qry);
						while($row = mysqli_fetch_array($rQry)){
							echo'<p>'.$row['org_name'].'</p>';
							echo'<p>'.$row['address'].'</p>';
							echo'<p>Email:'.$row['email'].'</p>';
							echo'<p>Phone:'.$row['phone1'].', '.$row['phone2'].'</p>';
						}
					?>
				</div>
				<h4 style="text-align:center;">Stations contacts</h4>
				<?php
					$qry = "SELECT * FROM terminals WHERE org_id=6";
					$rQry = mysqli_query($con, $qry);
					while($row = mysqli_fetch_array($rQry)){
							echo $row['terminal_name'].' - '.$row['contact1'].', '.$row['contact2'].'<br />';
					}
				?>
			</article>
		</section>
	</section>
	<?php
		if(isset($_POST['send_message'])){
			$fname = mysqli_real_escape_string($con, $_POST['full_names']);
			$phone = mysqli_real_escape_string($con, $_POST['phone']);
			$message = mysqli_real_escape_string($con, $_POST['message']);
			$org = 6;
			$q = "INSERT INTO messages (full_names,phone_no,message,org_id) VALUES('$fname','$phone','$message',$org)";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo '<script>alert("You have successfully send a message!")</script>';
				echo '<script>window.open("contact_us.php","_self")</script>';
			}
		}
	?>
<?php
	require_once("footer.php");
?>