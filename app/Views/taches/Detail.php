<!--
	@author   : Alizéa Lebaron
	@since    : 26/11/2024
	@version  : 2.0.0 - 27/11/2024
-->

<link rel="stylesheet" href="<?=base_url()."assets/css/detailTache.css";?>">

<div class="bg2">

	<?php echo form_open('/detailtache/modifComm'); ?>

	<?php echo form_submit('submit', 'Modifier cette tâche',"class='boutonModif'"); ?>

	<?php echo form_close(); ?>

	<div class="infoTache">
		<h2><?= $tache->getTitre() ?></h2>

		<div class="temps">
			<img src="<?=base_url()."assets/img/horloge.png";?>" alt="Horloge" class="small-image">
			<p class="annotation">
			<?php 
				$tempsRestant = $tache->getTempsRestant();
				$joursRestants = $tempsRestant->getDays();
				$heuresRestantes = $tempsRestant->getHours() % 24;

				if ($joursRestants > 0) : ?>
					<?= $joursRestants; ?> jour(s) 
					<?= $heuresRestantes; ?> heure(s)
				<?php else : ?>
					retard de 
					<?= abs($joursRestants); ?> jour(s) 
					<?= abs($heuresRestantes); ?> heure(s)
				<?php endif; ?>
			</p>
		</div>

		<div class="temps">
			<img src="<?=base_url()."assets/img/calendrier.png";?>" alt="Horloge" class="small-image">
			<p class="annotation"><?= $tache->getModiffTache()->format('d/m/Y'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?></p>

			<img src="<?=base_url()."assets/img/modif.png";?>" alt="Horloge" class="small-image">
			<p class="annotation"><?= $tache->getModiffTache()->format('d/m/Y'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?> </p>
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
							<td class="date"><img class="small-image" src="<?=base_url()."assets/img/calendrier.png";?>"><p class="annotation"><?= $commentaire->getCreationCommentaire()->format('d/m/Y'); ?> à <?= $commentaire->getCreationCommentaire()->format('H:i'); ?></p></td>
						</tr>

						<tr>
							<td class="commentaire" colspan="2"><?= $commentaire->getTexteCommentaire() ?></td>
						</tr>

					<?php endforeach; ?>
                </tbody>
            </table>
			
					

        <?php else : ?>

				 <p>Aucun commentaire pour le moment !</p>
		
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
