	<div style="min-height: 90vh;padding-top: 80px;">



		<div class="container my-4">
			<div class="row gy-2">


				<!-- Barre de recherche -->
				<div class="col-md-6 col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Rechercher..." aria-label="Recherche" aria-describedby="basic-addon2">
						<label class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></label>
					</div>
				</div>
		
				<!-- Select Trié par -->
				<div class="col-md-3 col-lg-4">
					<div class="input-group">
						<label class="input-group-text" for="type">Trié par</label>
						<select class="form-select" id="type">
							<option value="creation_tache">Date de modification</option>
							<option value="echeance"      >Echéance</option>
							<option value="retard"        >Retard</option>
							<option value="priorite"      >Priorité</option>
						</select>
					</div>
				</div>
		
				<!-- Select Ordre -->
				<div class="col-md-3 col-lg-4">
					<div class="input-group">
						<label class="input-group-text" for="order">Ordre</label>
						<select class="form-select" id="order">
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
							<th scope="col">Date de création</th>
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
								<td class="align-middle"><?= $tache['titre']; ?></td>
								<td class="align-middle"><?= $tache['creation_tache']; ?></td>
								<td class="align-middle"><?= $tache['modiff_tache']; ?></td>
								<td class="align-middle"><?= $tache['echeance']; ?></td>
								<td class="align-middle"> 
									<a href="<?php "/taches/supp/".$tache['id_tache'] ?>" class="btn btn-primaire"><i class="bi bi-trash3"></i></a> 
									<a href="<?php "/taches/".$tache['id_tache'] ?>" class="btn btn-primaire"><i class="bi bi-eye"></i></a> 
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
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						
						<!-- TODO : Faire la vrai pagination -->
						<li class="page-item"><a class="page-link" href="#">Previous</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
					</ul>
				</nav>
			</div>
			


	</div>