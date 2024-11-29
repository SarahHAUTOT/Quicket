

	<div class="bg">

		<div class="vh-100 d-flex justify-content-center align-items-center text-center">
			<div class="container mt-5 h-75">

				<div class="row w-100 bg-light border">

					
					<div class="col-md-4 my-4">
						<a  data-bs-toggle="modal" data-bs-target="#add" class="text-decoration-none">
							<div class="card h-100" style="background-color:#FF3354; color:white;">
								<div class="card-body text-center">
									<h5 class="card-title">Créer un nouveau projet <br><br> <i class="bi bi-plus-circle"></i> </h5>
								</div>
							</div>
						</a>
					</div>

					<?php if (!empty($projets)) : ?>
						<?php foreach ($projets as $projet):?>
							<div class="col-md-4 my-4">
								<a href="<?php echo "/taches/".$projet->getIdProjet() ?>" class="text-decoration-none">
									<div class="card h-100">
										<div class="card-body text-center">

										<?php
											$backgroundColor = $projet->getCouleur();  // Exemple de couleur de fond
											
											// Supprime le caractère '#' si présent
											$hexColor = ltrim($backgroundColor, '#');

											// Convertir en RGB
											$r = hexdec(substr($hexColor, 0, 2));
											$g = hexdec(substr($hexColor, 2, 2));
											$b = hexdec(substr($hexColor, 4, 2));

											// Calcul de la luminosité perçue (formule standard)
											$luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

											// Retourne "white" si la couleur est sombre, sinon "black"
											$textColor = ($luminance > 0.5) ? 'black' : 'white';
										?>

											<h5 class="card-title p-2 rounded" style="background-color: <?= $projet->getCouleur(); ?>; color : <?= $textColor ?>"><?= $projet->getNomProjet() ?></h5>
											<p class="card-text">
												<?php 
													$nb = count($projet->getTaches());
													echo $nb . " tache" . ($nb > 1?"s":"") ." <i class=\"bi bi-ui-checks\"></i>";
												?>
												<br>
												<?php 
													$nb = count($projet->getUtilisateurs());
													echo $nb . " participant" . ($nb > 1?"s":"") ." <i class=\"bi bi-people-fill\"></i>";
												?>
											</p>
										</div>
									</div>
								</a>
							</div>
						<?php endforeach;?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade <?= validation_errors() || isset(session('errors')['echeance']) ? 'show' : '' ?>" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="<?= validation_errors() || isset(session('errors')['echeance']) ? 'false' : 'true' ?>">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ajouter une tache</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>

				<div class="modal-body">
					<?php echo form_open('/projets/create',['id'=>'formCreate']); ?>

					<div class="form-group mb-2">
						<?php echo form_label('Nom du projet', 'nom_projet'); ?>
						
						<?php echo form_input([
							'name'        => 'nom_projet',
							'id'          => 'nom_projet',
							'class'       => 'form-control',
							'value'       => set_value('nom_projet'),
							'required'
						]); ?>

						<p class="text-danger"><?= validation_show_error('nom_projet') ?></p>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Couleur', 'couleur'); ?>
						
						<?php echo form_input([
							'name'        => 'couleur',
							'type'        => 'color',
							'id'          => 'couleur',
							'class'       => 'form-control',
							'value'       => set_value('couleur'),
							'required'
						]); ?>

						<p class="text-danger"><?= validation_show_error('couleur') ?>
					</div>

					<br>
					
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Créer le projet', "class='btn w-50 btn-principale' id='btnSub'"); ?>
					</div>


					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Include Bootstrap 5 Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url('/assets/js/redirection_filtre.js') ?>"></script>

	<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Si le modal contient des erreurs, on le déclenche
		if (document.querySelector('.modal.show')) {
			const modal = new bootstrap.Modal(document.getElementById('add'));
			modal.show();
		}

		document.getElementById('formCreate').onsubmit = function() {
			document.getElementById("formCreate").disabled = true;
		}
	});


	document.getElementById('formCreate').addEventListener('submit', function(event) {
		const submitButton = document.getElementById("btnSub"); // Correction ici
		if (this.checkValidity()) {
			// Disable the button only if the form is valid
			console.log("nnnnn")
			submitButton.classList.add('disabled');
			submitButton.style.pointerEvents = 'none';
			submitButton.innerHTML="<i class=\"bi bi-arrow-repeat\"></i>"
		} else {
			// Prevent submission and show validation errors
			event.preventDefault();
		}
	});

	</script>
