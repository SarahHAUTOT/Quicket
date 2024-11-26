<div style="min-height: 90vh;padding-top: 80px;">
        <div class="table-responsive mx-5">

            
            <!-- TODO : DECOMMENTER LIGNE -->
            <?php if (!empty($taches)) : ?>
            <table class="table">
                <thead>
                    <tr style="background-color: #009A80; color: antiquewhite;">
                        <th scope="col">Titre</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Date de modification</th>
                        <th scope="col">Echéance</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
					<!-- TODO : SUPP CETTE LIGNE DE TEST -->
					<tr>
						<td class="align-middle">titre</td>
						<td class="align-middle">creation_tache</td>
						<td class="align-middle">modiff_tache</td>
						<td class="align-middle">echeance</td>
						<td class="align-middle"> 
							<a href="/taches/supp/" class="btn"><i class="bi bi-trash3"></i></a> 
							<a href="/taches/" class="btn"><i class="bi bi-eye"></i></a> 
						</td>
					</tr>

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
        <?php else : ?>
            <p> Aucune tache crée. </p>    
        <?php endif; ?>

			<table class="table">
				<thead>
					<tr style="background-color: #009A80; color: antiquewhite;">
						<th scope="col">Titre</th>
						<th scope="col">Date de création</th>
						<th scope="col">Date de modification</th>
						<th scope="col">Echéance</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>

				<tbody>
					<!-- TODO : SUPP CETTE LIGNE DE TEST -->
					<tr class="table-danger">
						<td class="align-middle">titre</td>
						<td class="align-middle">creation_tache</td>
						<td class="align-middle">modiff_tache</td>
						<td class="align-middle">echeance</td>
						<td class="align-middle"> 
							<a href="/taches/supp/1" class="btn"><i class="bi bi-trash3"></i></a> 
							<a href="/taches/1" class="btn"><i class="bi bi-eye"></i></a> 
						</td>
					</tr>
                </tbody>
            </table>

            <a href="/taches/create" class="btn btn-principale">Ajouter une taches</a>

        </div>

    </div>