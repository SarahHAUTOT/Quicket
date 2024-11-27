	<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center text-center">
			<div class="container mt-5 h-75">

				<div class="h-100">
					<div class="d-flex h-100 align-items-center">

						<!-- Previous button -->
						<div class="d-flex justify-content-center align-items-center flex-shrink-0">
							<a href="/planning/<?= $date->modify('-1 day')->format('Y-M-d');?>" class="btn btn-principale">←</a>
						</div>

						<!-- Card for the current day -->
						<div class="flex-grow-1 mx-2 h-75">
							<div class="card h-100 rounded-0">

								<div class="border">
									<h5 class="card-title py-2" id="current-day-name"><?= $date->format('d M Y') ?></h5>
								</div>

								<div class="card-body overflow-auto">
									<div id="current-day-content text-left" >
										d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block d-lg-none d-block 
									</div>
								</div>
							</div>
						</div>

						<!-- Next button -->
						<div class="d-flex justify-content-center align-items-center flex-shrink-0">
							<a href="/planning/<?= $date->modify('+1 day')->format('Y-M-d');?>" class="btn btn-principale">→</a>
						</div>

					</div>
				</div>


			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>