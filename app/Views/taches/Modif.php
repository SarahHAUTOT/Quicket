<!--
	@author   : Alizéa Lebaron
	@since    : 27/11/2024
	@version  : 1.0.0 - 27/11/2024
-->

<link rel="stylesheet" href="<?=base_url()."assets/css/detailTache.css";?>">
<link rel="stylesheet" href="<?=base_url()."assets/css/modifTache.css";?>">

<div class="bg2">

	<div class="boutonOption">
		<a href="<?php echo "/taches/".$tache->getIdTache() ?>" class="boutonInfo">Retour aux informations</a>
		<a href="<?php echo "/taches/supp/".$tache->getIdTache() ?>" class="boutonSupp">Supprimer cette tâche</a>
	</div>



	<?php
		$id = $tache->getIdTache();
		echo form_open("/taches/modifier/$id"); 
	?>

	<div class="infoTache">

		<table class="head">
			<tr>
				<td rowspan=2 class="left"><h2>
						
						<?php echo form_input([
							'name'        => 'titre',
							'id'          => 'titre',
							'class'       => 'form-control',
							'value'       => set_value('titre', $tache->getTitre()),
							'required'
						]); ?>
						</h2>
						<p class="text-danger"><?= validation_show_error('titre') ?></p>
				</td>
				<td class="img"><img src="<?=base_url()."assets/img/calendrier.png";?>" alt="Horloge" class="small-image" title="Date de création"></td>
				<td class="annotation"><?= $tache->getModiffTache()->format('d/m/Y'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?></td>
			</tr>
			<tr>
				<td class="img"><img src="<?=base_url()."assets/img/modif.png";?>" alt="Horloge" class="small-image" title="Date de modification"></td>
				<td class="annotation"><?= $tache->getModiffTache()->format('d/m/Y'); ?> à <?= $tache->getModiffTache()->format('H:i'); ?></td>
			</tr>
			<tr>
				<td rowspan=2 class="left"><p class="prio">Priorité : 
						
						<?php 
							$options = 
							[
								'4'=> 'Négligeable',
								'3'=> 'Neutre',
								'2'=> 'Important',
								'1'=> 'Crucial',
							];
							echo form_dropdown('priorite', $options, set_value('priorite', $tache->getPriorite()), [
								'id'    => 'priorite',
								'class' => 'priorite',
								'required' => 'required'
							]);
						?>

					<p class="text-danger"><?= validation_show_error('priorite') ?></p>
				</td>
				<td class="img"><img src="<?=base_url()."assets/img/warning.png";?>" alt="Horloge" class="small-image" title="Date de l'échéance"></td>
							
							
				<td class="annotation">
					<?php echo form_input([
									'name'        => 'echeance',
									'id'          => 'echeance',
									'type'        => 'datetime-local',
									'class'       => 'echeance',
									'value'       => set_value('echeance', $tache->getEcheance()),
									'required'
								]); ?>

							
						<p class="text-danger"><?= validation_show_error('echeance') ?></p>
				</td>
			</tr>
			<tr>
				<td class="img">&nbsp;</td>
				<td class="annotation">&nbsp;</td>
			</tr>
		</table>
		
		<hr>
		
		<?php 
		$value = htmlspecialchars_decode(set_value('desc', $tache->getDescription()));

		echo form_textarea([
					'name'        => 'desc',
					'class'       => 'desc',
					'value'       => $value,  
					'required'
				]); 
		?>


		<div class="boutonEnre">
			<?php echo form_submit('submit', 'Enregistrer les modifications',"class='boutonModif2'"); ?>
		</div>
		
		<?php echo form_close(); ?>

		
	</div>

</div>
