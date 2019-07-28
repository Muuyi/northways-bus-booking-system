<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/busses.css" />
		<style>
		.btn_seats{
			color:#FFFFFF;
			margin:5px;
			font-weight:bolder;
			border-radius:5px;
			padding:10px;
		}
		.unbooked{
			background-color:#00008B;
		}
		.booked{
			background-color:#FF0000;
		}
		.booking{
			background-color:#FFD700;
		}
		.unbk_txt{
			color:#00008B;
			font-weight:bolder;
		}
		.bkd_txt{
			color:#FF0000;
			font-weight:bolder;
		}
		.bkng_txt{
			color:#FFD700;
			font-weight:bolder;
		}

		</style>
	</head>
<body>
	<button type="button" class="btn_seats unbooked" >Unbooked</button> <span class="unbk_txt">Unbooked seat</span>
	<button type="button" class="btn_seats booked" >Booked</button> <span class="bkd_txt">Booked seat</span>
	<button type="button" class="btn_seats booking" >Booking</button> <span class="bkng_txt">Booking in process</span>chtrvId
	<table id="adminBus">
		<tr>
			<td>
				<button type="button" class="seats unbooked" id="1A">1A</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="1B">1B</button>
			</td>
			<td colspan="2">

			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td rowspan="3">
			
			</td>
			<td>
				<button type="button" class="seats unbooked" id="2A">2A</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="2B">2B</button>
			</td>
		</tr>
		<tr>
			<td>
				<button type="button" class="seats unbooked" id="3A">3A</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="3B">3B</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="3C">3C</button>
			</td>
		</tr>
		<tr>
			<td>
				<button type="button" class="seats unbooked" id="4A">4A</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="4B">4B</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="4C">4C</button>
			</td>
		</tr>
		<tr>
			<td>
				<button type="button" class="seats unbooked" id="5A">5A</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="5B">5B</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="5C">5C</button>
			</td>
			<td>
				<button type="button" class="seats unbooked" id="5D">5D</button>
			</td>
		</tr>
	</table>
</body>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
		<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../jquery-ui-1.12.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/main.js"></script>