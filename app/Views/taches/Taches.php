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
									<a href="<?php echo "/taches/supp/".$tache->getIdTache(); ?>" class="btn btn-primaire"><i class="bi bi-trash3"></i></a> 
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

			<a href="/taches/create" class="btn btn-principale mx-5 my-2">Ajouter une taches</a>


			<div class="m-5">
			</div>
			


	</div>