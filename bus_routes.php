<?php
	require_once("header.php");
?>
	<section class="container-fluid">
		<section class="row">
			<aside class="col-md-1">
			</aside>
			<article class="col-md-10">
				<div class="card">
					<div class="card-header">
						<h4>Bus Routes & Fares
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 table-responsive">
								<table id="bus_routes" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Route id</th>
											<th>Departure location</th>
											<th>Destination location</th>
											<th>Bus fare</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</article>
			<aside class="col-md-1">
			</aside>
		</section>
	</section>
<?php
	require_once("footer.php");
?>