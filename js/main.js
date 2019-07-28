$(document).ready(function(){
	//FILLING THE BUS ROUTES SECTION WITH THE ROUTES AND THEIR PRICES
	var displayBusRoutes = "busRoutes";
	var adminsTable = $("#bus_routes").DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"ajax.php",
			method:"POST",
			data:{displayBusRoutes:displayBusRoutes,orgId:orgId},
		},
		"pageLength":25

	});
	var orgId = $("#orgInfo").val();
	//DISPLAYING TRAVELLING BUSSES ON THE MAIN PAGE
	var displayTravellingBusses = "travellingBusses";
	var travellingBusTable = $("#travelling_busses").DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"ajax.php",
			method:"POST",
			data:{displayTravellingBusses:displayTravellingBusses,orgId:orgId},
		},
		"pageLength":25

	});
	
	$(document).on('click', '.seats', function(){
			var stId = $(this).attr("id");
			var route = $("#adestLoc").val();
			var travlId = $("#atravTime").val();
			var cliId = $("#clientId").val();
			var orgId = $("#orgInfo").val();
			var clientSideIdNo = $("#clId").val();
			/*var random = Math.floor(Math.random()*1000)
			var randomno = stId+route+random;
			$("#clrandomno").val(randomno);*/
			$.ajax({
				url:'ajax.php',
				type:'POST',
				data:{stId:stId,stId:stId,route:route,travlId:travlId,cliId:cliId,orgId:orgId/*,clientSideIdNo:clientSideIdNo/*,randomno:randomno*/},
				success:function(data){
					if(data == "available"){
						alert("Already booked!");
					}else if(data == "starttimer"){
			//DELETING THE BOOKED SEAT IF THE USER STAYS LONG BEFORE SUBMITTING THE SEAT INFORMATION
						function deleteBooked(){
							var deleteBooked = "deleteBooked";
							$.ajax({
								url:'ajax.php',
								method:'POST',
								data:{deleteBooked:deleteBooked,cliId:cliId/*,clientSideIdNo:clientSideIdNo,*/,travlId:travlId},
								success:function(data){
									alert(data);
									document.location.reload(true);
								}
							});
						}
			//SETS THE SEAT TIMEOUT WHEN THE USER STAYS LONG BROE SUBMITTING THE SEAT INFORMATION
						clearSeatInterval = setTimeout(function(){
								deleteBooked();
						},10000);
			//DISPLAYS THE TIMER ON THE SCREEN FOR THE USER
						var totalTime = 10000;
						function timer(){
							var sec = totalTime/1000;
							$("#idError").text('You have '+sec+' seconds to complete the booking process');
							totalTime -= 1000;
						}
						  setInterval(function(){
							timer();
						}, 1000);
						
					}else{
						$("#idError").text(data);
					}
					
				}
			});
		});
	//SELECTING THE TRAVELLING DATE IN THE BOOK BUS SECTION
		$("#travDate").datepicker({
			numberOfMonths:2,
			showWeek:true,
			showOtherMonths:true,
			dateFormat:'yy-mm-dd',
			minDate: new Date()
		});
	//FILLING THE DEPARTURE COMBOBOX WITH THE DEPARTURE LOCATION AFTER SELECTNG THE TRAVELLING DATE IN THE BUS BOOKING SECTION
	$("#travDate").change(function(){
		if($("#clientId").val() == ''){
			$("#idError").text("Please enter ID before you continue with the booking process!");
			$("#clientId").css({'border':'1px solid #FF0000','backgroundColor':'#FF0000'});
			$("#adepLoc").html('<option value="">Please enter your ID number first</option>');
		}else{
			$("#idError").empty();
			$("#clientId").css({'border':'1px solid #008000','backgroundColor':'#FFFFFF'});
			var travDate = $(this).val();
			var orgId = $("#orgInfo").val();
			var travBusTermiCombo = "travBusTermiCombo";
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{travDate:travDate,orgId:orgId,travBusTermiCombo:travBusTermiCombo},
				success:function(data){
					$("#adepLoc").html('<option value="">Select bus terminal</option>'+data);
				}
			})
		}
	})
	//CONFIRMING IF THE ID NUMBER OF THE CLIENT EXISTS BEFORE COMPLETING THE BOOKING PROCESS
	$("#clientId").on('blur', function(){
			var clId = $(this).val();
			$.ajax({
				url:'ajax.php',
				type:'POST',
				data:{clId:clId},
				success:function(data){
					if(data != ''){
						$("#idResponse").html('<label class="alert alert-danger">The ID No/SSN No/Birth Cert No you have entered does not exist. Please enter your details to continue with the booking process</label>');
						$('#register').modal('show');
					}
				}
			})
		});
	//ENSURING THAT THE HEIGHT OF THE SECTIONS ON THE MAIN PAGE ARE EQUAL
		$(function(){
			var tallest = $("#leftSide").height();
			//$(".home").height(tallest);
			$columnsToEqualize = $(".home");
			$columnsToEqualize.each(function(){
				/*var thisHeight = $(this).height();
				if(thisHeight > tallest){
					tallest = thisHeight;
				}*/
				$columnsToEqualize.height(tallest);
			});
		});
	//FETCHING THE DESTINATION INFORMATION AFTER SELECTING THE DEPARTURE LOCATION
		$("#adepLoc").change(function(){
			var departure = $(this).val();
			var orgId = $("#orgInfo").val();
			$.ajax({
				url:'ajax.php',
				type:'POST',
				data:{departure:departure,orgId:orgId},
				success:function(data){
					$("#adestLoc").html('<option value="">Select destination</option>'+data);
				}
			})
				
		});
	//FETCHING THE DEPARTURE PERIOD FROM THE DATABASE AND POPULATING IT TO THE TRAVELLING TIME SECTION
		$("#adestLoc").change(function(){
			var rtId = $(this).val();
			var bkTrvlDate = $("#travDate").val();
			var chngTravellingTime = 'chngTravellingTime';
			$.ajax({
				url:'ajax.php',
				type:'POST',
				data:{rtId:rtId,chngTravellingTime:chngTravellingTime,bkTrvlDate:bkTrvlDate},
				success:function(data){
					$("#atravTime").html('<option value="">Select time</option>'+data);
				}
			})
		});
	//SELECTING THE BUS WITH THE CHANGE IN TIME IN BOOKING SECTION AT THE CLIENTS SECTION
		$("#atravTime").change(function(){
			var trvId = $(this).val();
			$.ajax({
				url:'ajax.php',
				type:'POST',
				data:{trvId:trvId},
				success:function(data){
					$("#busSection").load(data+'.php',function(){
						function checkSeats(){
							$(".seats").each(function(){
								var bkstId = $(this).attr("id");
								var bktrvId = trvId;
								$.ajax({
									url:'admins/ajax.php',
									type:'POST',
									data:{bkstId:bkstId,bktrvId:bktrvId},
									success:function(data){
										if(data == 'booking'){
											$("#"+bkstId).addClass("booking");
										}else if(data == 'booked'){
											$("#"+bkstId).addClass("booked");
										}else{
											$("#"+bkstId).addClass("unbooked");
										}
									}
								});
							});
						}
						checkSeats();
						setInterval(function(){
							checkSeats();
						}, 500);	
					});
				}
			})
		});
});