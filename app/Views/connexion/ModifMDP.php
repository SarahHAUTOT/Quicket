<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center">
			<div class="m-5 p-5 border text-align-center rounded form">

				
				<div class="d-flex justify-content-center align-items-center">
					<h2> Modification du mot de passe </h2>
				</div>

                <?php echo form_open('/connexion/mdp/change/'.$token); ?>
				
					<?php if (session()->has('errors')) : ?>
						<p class="text-danger">
							<?php foreach (session()->get('errors') as $erreur) : ?>
								<?= $erreur ?>
							<?php endforeach; ?>
						</p>
					<?php endif; ?>

					<div class="form-group mb-2">
						<?php echo form_label('Mots de passe', 'mdp'); ?>
						
						<?php echo form_input([
							'name'        => 'mdp',
							'id'          => 'mdp',
							'type'        => 'password',
							'class'       => 'form-control',
							'value'       => set_value('mdp'),
							'required'
						]); ?>

						<?= validation_show_error('mdp') ?>
					</div>


					<div class="form-group mb-2">
						<?php echo form_label('Confirmation de mot de passe', 'mdpConf'); ?>
						
						<?php echo form_input([
							'name'        => 'mdpConf',
							'id'          => 'mdpConf',
							'type'        => 'password',
							'class'       => 'form-control',
							'value'       => set_value('mdpConf'),
							'required'
						]); ?>

						<?= validation_show_error('mdpConf') ?>
					</div>
					
					<br>
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Valider',"class='btn w-50 btn-principale'"); ?>
					</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>