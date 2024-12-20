	<!--
	@author   : Sarah Hautot, Alizéa Lebaron
	@since    : 25/11/2024
	@version  : 1.1.1 - 26/11/2024
-->

<div style="min-height: 90vh;padding-top: 80px;">

		<div>
			<div class="ps-5 py-2">
				<a href="/projets" class="text-dark"><h1><i class="me-2 bi bi-arrow-left-short"></i>Projets</a>/<?php echo $projet->getNomProjet() ?></h1>
			</div>
		</div>



		<div class="container my-4">
			<div class="row gy-2">


				<!-- Barre de recherche -->
				<div class="col-md-6 col-lg-3">
					<div class="input-group">
						<input type="text" class="form-control" id="titre-recherche" value="<?=$titre?>" placeholder="Rechercher..." aria-label="Recherche" aria-describedby="titre-recherche">
					</div>
				</div>
		
				<!-- Select Trié par -->
				<div class="col-md-3 col-lg-3">
					<div class="input-group">
						<label class="input-group-text" for="trier-par">Trier par</label>
						<select class="form-select" id="trier-par">
							<option value="modiff_tache" <?php if (strcmp($trierPar, "modiff_tache")==0) echo "selected" ?>>Date de modification</option>
							<option value="echeance"     <?php if (strcmp($trierPar, "echeance"    )==0) echo "selected" ?>>Echéance</option>
							<option value="retard"       <?php if (strcmp($trierPar, "retard"      )==0) echo "selected" ?>>Retard</option>
							<option value="priorite"     <?php if (strcmp($trierPar, "priorite"    )==0) echo "selected" ?>>Priorité</option>
						</select>
					</div>
				</div>
		
				<!-- Select Ordre -->
				<div class="col-md-3 col-lg-3">
					<div class="input-group">
						<label class="input-group-text" for="ordre">Ordre</label>
						<select class="form-select" id="ordre">
							<option value="asc"  <?php if (strcmp($ordre, "asc" )==0) echo "selected" ?>>Croissant</option>
							<option value="desc" <?php if (strcmp($ordre, "desc")==0) echo "selected" ?>>Décroissant</option>
						</select>
					</div>
				</div>

				<div class="col-md-3 col-lg-2">
					<a href="#" id="lien-recherche" class="btn btn-troisieme" onclick="redirection_recherche(); this.style.pointerEvents='none'; this.style.opacity='0.5';">
						Rechercher <i class="bi bi-search"></i>
					</a>
				</div>
			</div>
		</div>
		






		<div class="table-responsive mx-5">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Titre</th>
						<th scope="col">Date de modification</th>
						<th scope="col">Echéance</th>
						<th scope="col">Terminé</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				
				<tbody>
					<?php if (!empty($taches)) : ?>
					<!-- Génération des lignes selon les données  -->
						<?php foreach ($taches as $tache) : ?>
							<!-- TODO : Calculer retard et mettre la classe "table-danger" sur le tr si dépassé -->
							<tr>
								<td class="align-middle"><?= $tache->getTitre(); ?></td>
								<td class="align-middle"><?= $tache->getModiffTache()->format('d/m/Y'); ?></td>
								<td class="align-middle"><?= $tache->getEcheance()->format('d/m/Y'); ?></td>
								<td class="align-middle">
									<input type="checkbox" name="est_termine" id="est_termine" 
										<?php if($tache->getEstTermine()) echo "checked"; ?>
										<?php if($tache->getIdUtilisateur() != session()->get('id_utilisateur')) echo "disabled"; ?>
									onclick="window.location.href = '<?= '/taches/etat/' . $tache->getIdProjet(). '/' .$tache->getIdTache() ?>';"
									>
								</td>
								<td class="align-middle"> 
									<a href="<?php echo "/taches/detail/".$tache->getIdProjet()."/".$tache->getIdTache() ?>" class="btn btn-troisieme" onclick="this.style.pointerEvents='none'; this.style.opacity='0.5';"><i class="bi bi-eye"></i></a> 

									<?php if ($projet->getIdCreateur() == session()->get('id_utilisateur')) : ?>
										<a href="<?php echo "/taches/supp/".$tache->getIdProjet()."/".$tache->getIdTache()."?page=".$pagerTache->getCurrentPage(); ?>" class="btn btn-secondaire" onclick="this.style.pointerEvents='none'; this.style.opacity='0.5';">
											<i class="bi bi-trash3"></i>
										</a>
									<?php endif; ?>

								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5" class="text-center py-3"> Aucune tache.</td> 
						</tr>
					<?php endif; ?>

					</tbody>
				</table>
			</div>

			<?php if (session()->get('id_utilisateur') == $projet->getIdCreateur()): ?>
				<button type="button" class="btn btn-principale mx-5 my-2" data-bs-toggle="modal" data-bs-target="#add">
					Ajouter une tache
				</button>

				<a href="/taches/participants/<?= $projet->getIdProjet() ?>" class="btn btn-principale mx-5 my-2">
					Participants
				</a>
			<?php endif; ?>

			<div class="m-5">
				<?= $pagerTache->links('default', 'pager_tache') ?>
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
					<?php echo form_open('/taches/create',['id'=>'formCreate']); ?>

					<input type="hidden" id="id_projet" name="id_projet" value=<?= $projet->getIdProjet() ?> />

					<div class="form-group mb-2">
						<?php echo form_label('Titre', 'titre'); ?>
						
						<?php 
							
							$value = isset($tache) ? htmlspecialchars_decode(set_value('titre', $tache->getTitre())) : set_value('titre');

							echo form_input([
							'name'        => 'titre',
							'id'          => 'titre',
							'class'       => 'form-control',
							'value'       => $value,
							'required'
						]); ?>

						<p class="text-danger"><?= validation_show_error('titre') ?></p>
					</div>
					


					<div class="form-group mb-2">
						<?php echo form_label('Priorité', 'priorite'); ?>
						
						<?php 
							$options = [
								'4'=> 'Négligeable',
								'3'=> 'Neutre',
								'2'=> 'Important',
								'1'=> 'Crucial',
							];
							echo form_dropdown([
								'name'    => 'priorite',
								'id'      => 'priorite',
								'class'   => 'form-select',
								'options' =>  $options,
								'value'   => set_value('priorite'),
								'required'
							]);
						?>

						<p class="text-danger"><?= validation_show_error('priorite') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Description', 'description'); ?>
						
						<?php 
							$value = isset($tache) ? htmlspecialchars_decode(set_value('description', $tache->getDescription())) : set_value('description');

							echo form_textarea([
							'name'        => 'description' ,
							'id'          => 'description' ,
							'class'       => 'form-control',
							'rows'        => '3',
							'maxlength'   => '255',
							'value'       =>  $value,
							'required'
						]); ?>

						<p class="text-danger"><?= validation_show_error('description') ?></p>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Echéance', 'echeance'); ?>
						
						<?php echo form_input([
							'name'        => 'echeance',
							'id'          => 'echeance',
							'type'        => 'datetime-local',
							'class'       => 'form-control',
							'value'       => set_value('echeance'),
							'required'
						]); ?>

						<p class="text-danger"><?php if (isset(session('errors')['echeance'])) echo session('errors')['echeance']; ?></p>
					</div>

					<br>
					
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Ajouter la tâche', "class='btn w-50 btn-principale' id='btnSub'"); ?>
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

