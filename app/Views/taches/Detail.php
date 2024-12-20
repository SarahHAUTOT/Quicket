<!--
	@author   : Alizéa Lebaron
	@since    : 26/11/2024
	@version  : 2.2.0 - 28/11/2024
-->

<link rel="stylesheet" href="<?=base_url()."assets/css/detailTache.css";?>">

<div class="bg2">

	<!-- Boutons pour modifier ou supprimer une tâche -->
	<div class="boutonOption">
		<?php if ($projet->getIdCreateur() == session()->get('id_utilisateur')) : ?>
			<a href="<?= "/taches/modif/".$tache->getIdProjet()."/".$tache->getIdTache() ?>" class="boutonModif">Modifier cette tâche</a>
			<a href="<?= "/taches/supp/".$tache->getIdProjet()."/".$tache->getIdTache() ?>" class="boutonSupp">Supprimer cette tâche</a>
		<?php endif; ?>
	</div>

	<!-- Div principale qui englobe toutes les informations -->
	<div class="infoTache">

		<!-- En-tête de l'information d'une tâche, toutes les informations importantes y sont -->
		<!-- J'ai utilisé un tableau pour mieux structurer les données  -->
		<table class="head">
			<tr>
				<td rowspan=2 class="left"><h2><a href="/taches/<?= $tache->getIdProjet() ?>" class="text-dark"><i class="me-2 bi bi-arrow-left-short"></i></a><?= $tache->getTitre() ?></h2></td>
				<td class="img"><img src="<?=base_url()."assets/img/calendrier.png";?>" alt="Horloge" class="small-image" title="Date de création"></td>

				<td class="annotation"><?= $tache->getCreationTache()->format('d/m/Y'); ?> à <?= $tache->getCreationTache()->format('H:i'); ?></td>
			</tr>
			<tr>
				<td class="img"><img src="<?=base_url()."assets/img/modif.png";?>" alt="Horloge" class="small-image" title="Date de modification"></td>

				<td class="annotation"><?= $tache->getModiffTache()->format('d/m/Y'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?></td>
			</tr>
			<tr>
				<td rowspan=2 class="left"><p class="prio">Priorité : <?= $tache->getPrioriteString() ?></p></td>

				<td class="img"><img src="<?=base_url()."assets/img/warning.png";?>" alt="Horloge" class="small-image" title="Date de l'échéance"></td>

				<td class="annotation"><?= $tache->getEcheance()->format('d/m/Y'); ?> à <?= $tache->getEcheance()->format('H:i'); ?></td>
			</tr>
			<tr>
				<td class="img"><img src="<?=base_url()."assets/img/horloge.png";?>" alt="Horloge" class="small-image" title="Nombre de jour avant l'échéance"></td>
				<td class="annotation">
					<!-- Calcul du temps restant par rapport à l'échéance -->
					<?php 
						$tempsRestant = $tache->getTempsRestant();
						$joursRestants = $tempsRestant->getDays();
						$heuresRestantes = $tempsRestant->getHours() % 24;

						if ($joursRestants > 0) : ?>
							Retard de 
							<?= $joursRestants; ?> jour(s) 
							<?= $heuresRestantes; ?> heure(s)
						<?php else : ?>
							Il reste
							<?= abs($joursRestants); ?> jour(s) et 
							<?= abs($heuresRestantes); ?> heure(s)
						<?php endif; ?>
				</td>
			</tr>
		</table>
		
		<hr>
		
		<textarea class="desc" name="desc" disabled><?= $tache->getDescription() ?></textarea>

		<h3 class="mt-4">Commentaire</h3>

		<!-- Affichage de tous les commentaires -->
		<?php if (!empty($commentaires)) : ?>

            <table class="tabComm">
                <tbody>
                    <!-- Génération des lignes selon les données  -->
					<?php foreach ($commentaires as $commentaire) : ?>
						<!-- TODO : Calculer retard et mettre la classe "table-danger" sur le tr si dépassé -->
						<tr class="infoComm">
							<td class="user"><?= $commentaire->getUtilisateur()->getPseudo() ?></td>
							<td class="date"><img class="small-image dateComm" src="<?=base_url()."assets/img/calendrier.png";?>"><p class="annotation"><?= $commentaire->getCreationCommentaire()->format('d/m/Y'); ?> à <?= $commentaire->getCreationCommentaire()->format('H:i'); ?></p></td>
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
        
        <div class="m-2">
			<?= $pagerCommentaire->links('default', 'pager_tache') ?>
		</div>

		<!-- Formulaire pour ajouter un commentaire -->
		<?php echo form_open('/detailtache/ajoutComm'); ?>

			<table class="tabComm">
				<tbody>

					<tr>
						<td colspan=2 class="mt-5 p-0"><?php echo form_label('Ajoutez votre commentaire : ', 'comm'); ?></td>
					</tr>

					<tr class="ajout">

						<td class="ajoutComm"> 
								
							<?php echo form_input(
								[
									'name'        => 'texte_commentaire',
									'id'          => 'texte_commentaire',
									'class'       => 'form-control',
									'value'       => set_value('Entrez votre commentaire ici...'),
									'required',
								]);
							?>

						</td>

						<input type="hidden" id="id_tache" name="id_tache" value=<?php echo $tache->getIdTache()?> />

						<td class="valid">
							<?php echo form_submit('submit', 'Enregistrer',"class='bouton'"); ?>
						</td>

					</tr>

				</tbody>

			</table>
			<input type="hidden" id="id_projet" name="id_projet" value=<?= $projet->getIdProjet() ?> />

			<p class="error"><?= validation_show_error('texte_commentaire') ?></p>

		<?php echo form_close(); ?>

	</div>

</div>
