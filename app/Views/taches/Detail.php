<!--
	@author   : Alizéa Lebaron
	@since    : 26/11/2024
	@version  : 1.0.1 - 26/11/2024
-->

<!--
A LIRE POUR SE CONNECTER A LA BDD : 

${nom} = A remplacé par le bon lien
$commentaires = listes des commentaires de cette tâche

-->

<link rel="stylesheet" href="<?=base_url()."assets/css/detailTache.css";?>">

<div class="bg">

	<?php echo form_open('/detailtache/modifComm'); ?>

	<?php echo form_submit('submit', 'Modifier cette tâche',"class='boutonModif'"); ?>

	<?php echo form_close(); ?>

	<div class="infoTache">
		<h2><?= $tache->getTitre() ?></h2>

		<div class="temps">
			<img src="<?=base_url()."assets/img/horloge.png";?>" alt="Horloge" class="small-image">
			<p class="annotation">${TempsRestant} jour(s)</p>
		</div>

		<div class="temps">
			<img src="<?=base_url()."assets/img/calendrier.png";?>" alt="Horloge" class="small-image">
			<p class="annotation"><?= $tache->getModiffTache()->format('Y-m-d'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?></p>

			<img src="<?=base_url()."assets/img/modif.png";?>" alt="Horloge" class="small-image">
			<p class="annotation"><?= $tache->getModiffTache()->format('Y-m-d'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?> </p>
		</div>
		
		<hr>

		<textarea class="desc" name="desc" disabled><?= $tache->getDescription() ?></textarea>

		<h3 class="mt-4">Commentaire</h3>

		<?php if (!empty($commentaires)) : ?>
            <table class="tabComm">
                <tbody>
                    <!-- Génération des lignes selon les données  -->
					<?php foreach ($commentaires as $commentaire) : ?>
						<!-- TODO : Calculer retard et mettre la classe "table-danger" sur le tr si dépassé -->
						<tr class="infoComm">
							<td class="user"><?= $commentaire->getIdUtilisateur() ?></td>
							<td class="date"><img class="small-image" src="<?=base_url()."assets/img/calendrier.png";?>"><p class="annotation"><?= $commentaire->getCreationCommentaire()->format('Y-m-d'); ?> à <?= $commentaire->getCreationCommentaire()->format('H:i'); ?></p></td>
						</tr>

						<tr>
							<td class="commentaire" colspan="2"><?= $commentaire->getTexteCommentaire() ?></td>
						</tr>

					<?php endforeach; ?>
                </tbody>
            </table>
			
					

        <?php else : ?>

			<!-- A supprimer plus tard et décommenter l'autre ligne dessous -->
			<table class="tabComm">
				<tbody>
					<tr class="infoComm">
						<td class="user">User_253694</td>
						<td class="date"><img class="small-image" src="<?=base_url()."assets/img/calendrier.png";?>"><p class="annotation">26/11/2024 18:55</p></td>
					</tr>

					<tr>
						<td class="commentaire" colspan="2">Lorem Ipsum Dolores Sit Ames</td>
					</tr>

					<tr class="infoComm">
						<td class="user">User_253694</td>
						<td class="date"><img class="small-image" src="<?=base_url()."assets/img/calendrier.png";?>"><p class="annotation">28/11/2024 13:45</p></td>
					</tr>

					<tr>
						<td class="commentaire" colspan="2">Les ornithorynque sont des mammifères ☝️🤓</td>
					</tr>


				</tbody>
			</table>
				 <!-- <p>Aucun commentaire pour le moment !</p>     -->
		
			<?php endif; ?>


			<?php echo form_open('/detailtache/ajoutComm'); ?>

			<table class="tabComm">
				<tbody>

					<tr>
						<td colspan=2 class="mt-5 p-0"><?php echo form_label('Ajoutez votre commentaire : ', 'comm'); ?></td>
					</tr>

					<tr class="ajout">
						<td class="ajoutComm"> 
								
								<?php echo form_input([
									'name'        => 'comm',
									'id'          => 'comm',
									'class'       => 'form-control',
									'value'       => set_value('Entrez votre commentaire ici...'),
									'required'
								]); 
							?>

							<?= validation_show_error('pseudo') ?>
						</td>

						<td class="valid">
							<?php echo form_submit('submit', 'Enregistrer',"class='bouton'"); ?>
						</td>
					</tr>

					<?php echo form_close(); ?>

				</tbody>

			</table>

	</div>

	

</div>
