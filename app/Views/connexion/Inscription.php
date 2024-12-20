	<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center">
			<div class="m-5 p-5 border text-align-center rounded form">

				
				<div class="d-flex justify-content-center align-items-center">
					<h2>Créer un nouveau compte </h2>
				</div>

				<?php if (session()->getFlashdata('validation')): ?>
					<div class="alert alert-danger">
						<ul>
							<?php foreach (session()->getFlashdata('validation') as $error): ?>
								<li><?= esc($error) ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

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
						<?php echo form_label('Mot de passe', 'mdp'); ?>
						
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
						<?php echo form_submit('submit', 'S\'inscrire',"class='btn w-50 btn-principale' onclick=\"this.classList.add('disabled')\""); ?>
					</div>

				<?php echo form_close(); ?>
					
				<div class="d-flex justify-content-center align-items-center">
					<a href="/connexion" class="btn btn-link"> Déjà inscrit ? Connectez-vous !</a> 
				</div>
			</div>
		</div>
	</div>