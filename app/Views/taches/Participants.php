	<!--
	@author   : Sarah Hautot, Alizéa Lebaron
	@since    : 25/11/2024
	@version  : 1.1.1 - 26/11/2024
-->

<div style="min-height: 90vh;padding-top: 80px;">

		<div class="table-responsive mx-5">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Nom</th>
						<th scope="col">Email</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				
				<tbody>
					<?php if (!empty($participants)) : ?>
					<!-- Génération des lignes selon les données  -->
						<?php foreach ($participants as $participant) : ?>
							<!-- TODO : Calculer retard et mettre la classe "table-danger" sur le tr si dépassé -->
							<tr>
								<td class="align-middle"><?= $participant->getPseudo(); ?></td>
								<td class="align-middle"><?= $participant->getEmail(); ?></td>
								<td class="align-middle"> 
									<a href="<?php echo "/participants/supp/".$idProjet."/".$participant->getIdUtilisateur()."?page=".$pagerTache->getCurrentPage(); ?>" class="btn btn-secondaire" onclick="this.style.pointerEvents='none'; this.style.opacity='0.5';">
										<i class="bi bi-trash3"></i>
									</a> 
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="2" class="text-center py-3"> Aucun participant.</td> 
						</tr>
					<?php endif; ?>

					</tbody>
				</table>
			</div>

			<button type="button" class="btn btn-principale mx-5 my-2" data-bs-toggle="modal" data-bs-target="#add">
				Ajouter des participants
			</button>

			<button href="/taches/<?= $idProjet ?>" type="button" class="btn btn-principale mx-5 my-2">
				Taches
			</button>



	
			<div class="m-5">
				<?= $pagerTache->links('default', 'pager_participant') ?>
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
					<?php echo form_open('/taches/participants/add',['id'=>'formCreate']); ?>

						<?php echo form_input([
							'name'        => 'id_projet',
							'id'          => 'id_projet',
							'type'        => 'hidden',
							'value'       => set_value($idProjet),
							'required'
						]); ?>

					<div class="form-group mb-2">
						<?php echo form_label('Email de l\'utilisateur', 'email'); ?>
						
						<?php echo form_input([
							'name'        => 'email',
							'id'          => 'email',
							'class'       => 'form-control',
							'value'       => set_value('email'),
							'required'
						]); ?>

						<p class="text-danger"><?= validation_show_error('email') ?></p>
					</div>

					<br>
					
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Partager', "class='btn w-50 btn-principale' id='btnSub'"); ?>
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

