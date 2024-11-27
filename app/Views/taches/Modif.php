<!--
	@author   : Alizéa Lebaron
	@since    : 27/11/2024
	@version  : 1.0.0 - 27/11/2024
-->

<link rel="stylesheet" href="<?=base_url()."assets/css/detailTache.css";?>">

<div class="bg2">

	<div class="boutonOption">
		<a href="<?php echo "/taches/".$tache->getIdTache() ?>" class="boutonInfo">Retour aux informations</a>
		<a href="<?php echo "/taches/supp/".$tache->getIdTache() ?>" class="boutonSupp">Supprimer cette tâche</a>
	</div>

	<?php echo form_open('/TEXT'); ?>

	<div class="infoTache">

		<table class="head">
			<tr>
				<td rowspan=2 class="left"><h2><?= $tache->getTitre() ?></h2></td>
				<td class="img"><img src="<?=base_url()."assets/img/calendrier.png";?>" alt="Horloge" class="small-image" title="Date de création"></td>
				<td class="annotation"><?= $tache->getModiffTache()->format('d/m/Y'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?></td>
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

		<textarea class="desc" name="desc"><?= $tache->getDescription() ?></textarea>

		<div class="boutonEnre">
			<?php echo form_submit('submit', 'Enregistrer les modifications',"class='boutonModif2'"); ?>
		</div>
		
		<?php echo form_close(); ?>

		
	</div>

</div>
