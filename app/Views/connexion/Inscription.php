	<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center">
			<div class="m-5 p-5 border text-align-center rounded form">

				
				<div class="d-flex justify-content-center align-items-center">
					<h2>Créer un nouveau compte </h2>
				</div>

				<?php echo form_open('/inscription/create'); ?>

					<div class="form-group mb-2">
						<?php echo form_label('Pseudo', 'pseudo'); ?>
						
						<?php echo form_input([
							'name'        => 'pseudo',
							'id'          => 'pseudo',
							'class'       => 'form-control',
							'value'       => set_value('pseudo'),
							'required'
						]); ?>

						<?= validation_show_error('pseudo') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Email', 'email'); ?>
						
						<?php echo form_input([
							'name'        => 'email',
							'id'          => 'email',
							'class'       => 'form-control',
							'value'       => set_value('email'),
							'required'
						]); ?>

						<?= validation_show_error('email') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Mots de passe', 'mdp'); ?>
						
						<?php echo form_input([
							'name'        => 'mdp',
							'id'          => 'mdp',
							'class'       => 'form-control',
							'value'       => set_value('mdp'),
							'required'
						]); ?>

						<?= validation_show_error('mdp') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Confirmation de mots de passe', 'mdpConf'); ?>
						
						<?php echo form_input([
							'name'        => 'mdpConf',
							'id'          => 'mdpConf',
							'class'       => 'form-control',
							'value'       => set_value('mdpConf'),
							'required'
						]); ?>

						<?= validation_show_error('mdpConf') ?>
					</div>
					
					<br>
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'S\'inscrire',"class='btn w-50 btn-principale'"); ?>
					</div>

				<?php echo form_close(); ?>
					
				<div class="d-flex justify-content-center align-items-center">
					<a href="/connexion" class="btn btn-link"> Déja inscris ?Connectez vous !</a> 
				</div>
			</div>
		</div>
	</div>