<?php
	require_once("db.php");
	//DISPLAYING THE LIST OF COUNTRIES IN THE COUNTRIES SECTION
	function getCountries(){
		global $con;
		$q = "SELECT * FROM countries";
		$rQ = mysqli_query($con, $q);
		while($rs = mysqli_fetch_array($rQ)){
			echo '<option value="'.$rs['country_id'].'">'.$rs['name'].'</option>';
		}
	}
?>