	<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center text-center">
			<div class="container mt-5 h-75">

				<div class="h-100">
					<div class="d-flex h-100 align-items-center">

						<!-- Previous button -->
						<div class="d-flex justify-content-center align-items-center flex-shrink-0">
							<a href="/planning/<?php $date2 = clone $date; echo $date2->modify('-1 day')->format('Y-M-d');?>" class="btn btn-principale">←</a>
						</div>

						<!-- Card for the current day -->
						<div class="flex-grow-1 mx-2 h-75">
							<div class="card h-100 rounded-0">

								<div class="border card-head">
									<h3 class="card-title py-2" id="current-day-name"><?= $date->format('d M Y') ?></h3>
								</div>

								<div class="card-body overflow-auto p-0">

									<?php foreach ($taches as $tache) :?>
										<a href="<?php echo "/taches/detail/".$tache->getIdTache() ?>" class="nav-link">
											<div class="d-flex justify-content-between align-items-center bg-secondary p-2 px-3 lstTache">
												<!-- Titre à gauche -->
												<div class="text-start">
													<?php 
														switch ($tache->getPriorite()) {
															case 1 : echo '<i class="bi me-2 bi-exclamation-triangle-fill"></i>'; break;
															case 2 : echo '<i class="bi me-2 bi-exclamation-lg"></i>'           ; break;
															case 3 : echo '<i class="bi me-2 bi-exclamation"></i>'              ; break;
															case 4 : echo '<i class="bi me-2"></i>'                             ; break;
														}
													?>
													<?= $tache->getTitre() ?>
												</div>

												<!-- Temps restant à droite -->
												<div class="text-end">
													<?php
														// Calcule du temps restant
														$now = new \DateTime();
														$deadline = $tache->getEcheance();
														
														if ($deadline < $now) {
															echo "Retard de ";
														}

														$interval = $deadline->diff($now);
														if ($interval->days > 0) {
															echo $interval->days . ' jour' . ($interval->days > 1 ? 's ' : ' ');
														} else {
															echo $interval->h . 'heure'.($interval->h > 1 ? 's' : '').' et ' . $interval->i . ' minute'.($interval->i > 1 ? 's' : '');
														}

														
														
														if ($deadline < $now) {
															echo '<i class="bi bi-hourglass-bottom"></i>';
														}else{
															echo '<i class="bi bi-hourglass-split"></i>';
														}
													?>
												</div>
											</div>
										</a>
									<?php endforeach; ?>
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
	<link rel="stylesheet" href="<?=base_url()."assets/css/planning.css";?>">