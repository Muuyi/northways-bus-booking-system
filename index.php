<?php
	require_once("functions.php");
	require_once("header.php");
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="aside home" id="leftSide">
				<div class="aside-header" style="color:#FFD700; font-weight:bolder;background-color:#34495E;">BOOK NOW</div>
				<div class="aside-body" id="busSection">
					<form method="POST">
						<div class="form-group">
							<?php 
								$q = "SELECT * FROM organizations WHERE username='northways'";
								$rQ = mysqli_query($con, $q);
								$result = mysqli_fetch_array($rQ);
							?>
							<input type="hidden" value="<?php echo $result['org_id']?>" id="orgInfo" />
							<label class="label">Enter ID number/Birth cert/SSN</label>
							<input type="number" class="form-control" id="clientId" Placeholder="Please enter ID/Birth cert No/SSN" />
							<div class="error" id="idError"></div>
						</div>
						<div class="form-group">
							<label for="terminal" class="label">Select travelling date</label>
							<input type="text" id="travDate" class="form-control" placeholder="Select travelling date" readonly/>
						</div>
						<div class="form-group">
							<label for="terminal" class="label">Select Bus Terminal</label>
							<select class="form-control" name="" id="adepLoc">
								<option>Select travelling date first</option>
							</select>
						</div>
						<div class="form-group">
							<label for="terminal" class="label">Select bus destination</label>
							<select class="form-control" id="adestLoc">
								<option value="">Select bus terminal first</option>
							</select>
						</div>
						<div class="form-group">
							<label for="terminal" class="label">Select Time</label>
							<select class="form-control" id="atravTime">
								<option value="">Select bus destination first</option>
							</select>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6 home">
			<img src="images/northway1.jpg" height="100%" width="100%"/>
		</div>
		<div class="col-md-3">
			<div class="aside home">
				<div class="aside-header" style="color:#FFD700; font-weight:bolder;background-color:#34495E;">NEWS & NOTICES</div>
				<div class="aside-body">
					
				</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Our main stations</h4>
				</div>
				<div class="card-body">
					<?php
					//SELECTING THE MAIN BUS STATIONS
					$q = "SELECT * FROM terminals WHERE org_id=6";
					$rQ = mysqli_query($con, $q);
					if(mysqli_num_rows($rQ) > 0){
						while($row = mysqli_fetch_array($rQ)){
							echo '<span style="font-weight:bolder;">'.$row['terminal_name'].',</span> ';
						}
					} 
					?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Our customers responses</h4>
				</div>
				<div class="card-body">
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>About us</h4>
				</div>
				<div class="card-body">
				</div>
			</div>
		</div>
	</div>
</div>
<!--REGISTER MODAL WINDOW-->
	<section class="modal fade" id="register">
		<article class="modal-dialog modal-lg">
			<div class="modal-content">
				<form method="POST" action="post.php">
					<div class="modal-header">
						<h3 style="font-weight:bolder; color:#860000;">Register</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" style="color:#00008B; font-weight:bolder;">
						<div class="row" id="idResponse">
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="fName">First Name</label>
									<input type="text" name="fname" class="form-control" placeholder="Enter first name" required/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="lName">Last Name</label>
									<input type="text" name="lname" class="form-control" placeholder="Enter first name" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="idNo">ID Number/Social Security No/Birth certificate n:</label>
									<input type="number" name="id" class="form-control" placeholder="Enter ID No" required/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="phone">Phone Number</label>
									<input type="number" name="phone" class="form-control" placeholder="Enter phone number" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">Email address:</label>
									<input type="email" name="email" class="form-control" placeholder="Enter email address" required/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="gender">Gender</label><br />
									<input type="radio" value="M" name="gender"/> Male
									<input type="radio" value="F" name="gender"/> Female
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="country">Select Country:</label>
									<select class="form-control" name="country" id="country">
										<option val="">Select a country</option>
										<?php getCountries(); ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="password">Password:</label>
									<input type="password" class="form-control" name="password" placeholder="Enter password" required/>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="saveClient">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
					</div>
				</form>
			</div>
		</article>
	</section>
<?php
	require_once("footer.php");
?>