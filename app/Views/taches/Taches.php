	<!--
	@author   : Sarah Hautot, Alizéa Lebaron
	@since    : 25/11/2024
	@version  : 1.1.0 - 26/11/2024
-->

<div style="min-height: 90vh;padding-top: 80px;">



		<div class="container my-4">
			<div class="row gy-2">


				<!-- Barre de recherche -->
				<div class="col-md-6 col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" id="titre-recherche" placeholder="Rechercher..." aria-label="Recherche" aria-describedby="titre-recherche">
						<label class="input-group-text" id="titre-recherche">
							<a href="#" id="lien-recherche" onclick="redirection_recherche()">
								<i class="bi bi-search"></i>
							</a>
						</label>
					</div>
				</div>
		
				<!-- Select Trié par -->
				<div class="col-md-3 col-lg-4">
					<div class="input-group">
						<label class="input-group-text" for="trier-par">Trié par</label>
						<select class="form-select" id="trier-par">
							<option value="modiff_tache">Date de modification</option>
							<option value="echeance"      >Echéance</option>
							<option value="retard"        >Retard</option>
							<option value="priorite"      >Priorité</option>
						</select>
					</div>
				</div>
		
				<!-- Select Ordre -->
				<div class="col-md-3 col-lg-4">
					<div class="input-group">
						<label class="input-group-text" for="ordre">Ordre</label>
						<select class="form-select" id="ordre">
							<option value="asc" >Croissant</option>
							<option value="desc">Décroissant</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		






		<div class="table-responsive mx-5">
			<!-- TODO : DECOMMENTER LIGNE -->
			<?php if (!empty($taches)) : ?>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Titre</th>
							<th scope="col">Date de modification</th>
							<th scope="col">Echéance</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>

					<tbody>
						<!-- Génération des lignes selon les données  -->
						<?php foreach ($taches as $tache) : ?>
							<!-- TODO : Calculer retard et mettre la classe "table-danger" sur le tr si dépassé -->
							<tr>
								<td class="align-middle"><?= $tache->getTitre(); ?></td>
								<td class="align-middle"><?= $tache->getModiffTache()->toDateString(); ?></td>
								<td class="align-middle"><?= $tache->getEcheance()->toDateString(); ?></td>
								<td class="align-middle"> 
									<a href="<?php echo "/taches/supp/".$tache->getIdTache()."?page=".$pagerTache->getCurrentPage(); ?>" 
									   class="btn btn-primaire">
									   <i class="bi bi-trash3"></i>
									</a> 
									<a href="<?php echo "/taches/".$tache->getIdTache() ?>" class="btn btn-primaire"><i class="bi bi-eye"></i></a> 
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<?php else : ?>
				<p class="mx-5"> Aucune tache crée. </p>    
			<?php endif; ?>

			<button type="button" class="btn btn-principale mx-5 my-2" data-bs-toggle="modal" data-bs-target="#add">
				Ajouter une tache
			</button>


			<div class="m-5">
			</div>
			


	</div>

	<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ajouter une tache</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>

				<div class="modal-body">
					<?php echo form_open('/taches/create'); ?>

					<div class="form-group mb-2">
						<?php echo form_label('Titre', 'titre'); ?>
						
						<?php echo form_input([
							'name'        => 'titre',
							'id'          => 'titre',
							'class'       => 'form-control',
							'value'       => set_value('titre'),
							'required'
						]); ?>

						<?= validation_show_error('titre') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Priorité', 'priorite'); ?>
						
						<?php 
							$options = [
								'1'=> 'A faire',
								'2'=> 'Important',
								'3'=> 'Cruciale',
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

						<?= validation_show_error('priorite') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Description', 'description'); ?>
						
						<?php echo form_textarea([
							'name'        => 'description' ,
							'id'          => 'description' ,
							'class'       => 'form-control',
							'rows'        => '3',
							'maxlength'   => '255',
							'value'       => set_value('description'),
							'required'
						]); ?>

						<?= validation_show_error('description') ?>
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

						<?= validation_show_error('echeance') ?>
					</div>

					<br>
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Ajouter la tache',"class='btn w-50 btn-principale'"); ?>
					</div>

					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

<!-- Include Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
