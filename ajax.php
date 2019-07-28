<?php
	require_once("db.php");
	//DISPLAY BUS ROUTES
	if(isset($_POST['displayTravellingBusses'])){
		$query = "";
		$output = array();
		$query .= "SELECT tb.travel_date AS td,br.departure AS dep,br.destination AS des,b.bus_name AS bn,b.no_plates AS np,tb.travel_time AS tt,br.amount AS a FROM ((travelling_busses AS tb INNER JOIN bus_routes AS br ON tb.route_id = br.route_id) INNER JOIN busses AS b ON tb.bus_id = b.bus_id) WHERE tb.org_id=".$_POST['orgId']." AND ";
		if(isset($_POST["search"]['value'])){
			$query .= '(tb.travel_date LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR departure LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR destination LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR bus_name LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR travel_time LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR amount LIKE "%'.$_POST["search"]['value'].'%")';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}else{
			$query .= 'ORDER BY travel_date ASC ';
		}
		if($_POST["length"] != -1){
			$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
		}
		$runQuery = mysqli_query($con, $query);
		if($runQuery){
			$data = array();
			$noOfRows = mysqli_num_rows($runQuery);
			while($row = mysqli_fetch_array($runQuery)){
				$sub_array = array();
				$sub_array[] = $row['td'];
				$sub_array[] = $row['dep'].'-'.$row['des'];
				$sub_array[] = $row['bn'];
				$sub_array[] = $row['tt'].' Hrs';
				$sub_array[] = $row['a'];
				$data[] = $sub_array;
			}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>	get_all_travelling_busses($con),
				"data"			=>	$data	

			);
			echo json_encode($output);
		}else{
			echo mysqli_error($con);
		}
		
	}
	function get_all_travelling_busses($con){
		$q = "SELECT * FROM travelling_busses WHERE org_id=6";
		$rQ = mysqli_query($con, $q);
		return mysqli_num_rows($rQ);
	}
	//DISPLAY BUS ROUTES
	if(isset($_POST['displayBusRoutes'])){
		$query = "";
		$output = array();
		$query .= "SELECT * FROM bus_routes WHERE org_id='".$_POST['orgId']."' AND ";
		if(isset($_POST["search"]['value'])){
			$query .= '(departure LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR destination LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR amount LIKE "%'.$_POST["search"]['value'].'%")';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}else{
			$query .= 'ORDER BY route_id ASC ';
		}
		if($_POST["length"] != -1){
			$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
		}
		$runQuery = mysqli_query($con, $query);
		if($runQuery){
			$data = array();
			$noOfRows = mysqli_num_rows($runQuery);
			while($row = mysqli_fetch_array($runQuery)){
				$sub_array = array();
				$sub_array[] = $row['route_id'];
				$sub_array[] = $row['departure'];
				$sub_array[] = $row['destination'];
				$sub_array[] = $row['amount'];
				$data[] = $sub_array;
			}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>	get_total_all_records($con),
				"data"			=>	$data	

			);
			echo json_encode($output);
		}else{
			echo mysqli_error($con);
		}
		
	}
	function get_total_all_records($con){
		$q = "SELECT * FROM bus_routes WHERE org_id=6";
		$rQ = mysqli_query($con, $q);
		return mysqli_num_rows($rQ);
	}
	//POSTING SELECTED SEAT INFORMATION TO THE DATABASE VALUES TO THE DATA BASE
	if(isset($_POST['stId'])){
		$stId = $_POST['stId'];
		$route = $_POST['route'];
		$travlId = $_POST['travlId'];
		$clId = $_POST['cliId'];
		$org = $_POST['orgId'];
		//$randomno = $_POST['randomno'];
		$q = "SELECT * FROM clients WHERE id_no ='".$clId."'";
		$rQ = mysqli_query($con, $q);
		if(mysqli_num_rows($rQ)>0){
			$qry = "SELECT * FROM bookings WHERE seat_no = '".$stId."' AND route_id = '".$route."' AND travel_id='".$travlId."'";
			$rQry = mysqli_query($con, $qry);
			if(mysqli_num_rows($rQry) > 0){
				echo "available";
			}else{
				$qry = "INSERT INTO bookings (id_no,seat_no,route_id,travel_id,org_id,bk_time) VALUES('$clId','$stId','$route','$travlId','$org',now()) ";
				$rQ = mysqli_query($con, $qry);
				if($rQ){
					echo "starttimer";
				}
			}
		}else{
			echo "The ID Number selected does not exist. Please ensure that you have entered the correct number or click on the register button to register the client before proceeding with the booking process!";
		}
	}
	//POPULATING THE BUS SECTION IN THE ADMIN BOOKING SECTION WITH THE BUS
	if(isset($_POST['trvId'])){
		$q = "SELECT busses.no_seats AS seats FROM travelling_busses INNER JOIN busses ON travelling_busses.bus_id=busses.bus_id WHERE travel_id='".$_POST['trvId']."'";
			$rQ = mysqli_query($con, $q);
			if(mysqli_num_rows($rQ) > 0){
				while($rw = mysqli_fetch_array($rQ)){
					$seats = $rw['seats'];
					echo $seats;
				}
			}else{
				echo 'No value for the departure location!';
			}
	}
	//PUPULATING THE TRAVELLING COMBOBOX WITH TIME
	if(isset($_POST['chngTravellingTime'])){
		$q = "SELECT * FROM travelling_busses WHERE route_id='".$_POST['rtId']."' AND travel_date='".$_POST['bkTrvlDate']."'";
		$rQ = mysqli_query($con, $q);
		if(mysqli_num_rows($rQ) > 0){
			while($rw = mysqli_fetch_array($rQ)){
				echo '<option value="'.$rw['travel_id'].'">'.$rw['travel_time'].' Hrs'.'</option>';
			}
		}else{
			echo '<option value="" style="color:#FF0000;">No value for the time of this route!</option>';
		}
	}
	//POPULATING THE ADD TRAVELLING BUS DESTINATION LOCATION COMBOBOX WITH DATA IN ADMIN SECTION
	if(isset($_POST['departure'])){
			$q = "SELECT * FROM bus_routes INNER JOIN travelling_busses ON bus_routes.route_id=travelling_busses.route_id WHERE bus_routes.route_id='".$_POST['departure']."' AND travelling_busses.org_id='".$_POST['orgId']."' GROUP BY destination ORDER BY destination ASC";
			$rQ = mysqli_query($con, $q);
			if(mysqli_num_rows($rQ) > 0){
				while($rw = mysqli_fetch_array($rQ)){
					echo '<option value="'.$rw['route_id'].'">'.$rw['destination'].'</option>';
				}
			}else{
				echo '<option value="" style="color:#FF0000;">THERE IS NO VALUE FOR A DEPARTURE LOCATION</option>';
			}
	}
	//ENSURING THE ID NUMBER EXISTS BEFORE BOOKING THE BUS
	if(isset($_POST['clId'])){
		$q = "SELECT id_no FROM clients WHERE id_no='".$_POST['clId']."'";
		$rQ = mysqli_query($con, $q);
		if(mysqli_num_rows($rQ) > 0){
			echo "";
		}else{
			echo "There is no client with the above details!Please confirm that you have entered the correct details or click the register button to register the client before proceeding with the booking process!";
		}
	}
	//FILLING THE BUS BOOKING TERMINAL COMBO BOX WITH DATA
	if(isset($_POST['travBusTermiCombo'])){
		$q = "SELECT * FROM travelling_busses INNER JOIN bus_routes ON travelling_busses.route_id=bus_routes.route_id WHERE travel_date='".$_POST['travDate']."' AND travelling_busses.org_id='".$_POST['orgId']."'";

		$rQ = mysqli_query($con, $q);
		if($rQ){
			if(mysqli_num_rows($rQ) > 0){
				while($rw = mysqli_fetch_array($rQ)){
				echo '
					<option value="'.$rw['route_id'].'">'.$rw['departure'].'</option>
				';
				}
			}else{
				echo '<option value="">THERE IS NO BUS SELECTED FOR TRAVELLING ON THAT DAY</option>';
			}
			
		}else{
			echo mysqli_error($con);
		}
			
	}
?>