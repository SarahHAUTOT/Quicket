	<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center">
			<div class="m-5 p-5 border text-align-center rounded form">

				
				<div class="d-flex justify-content-center align-items-center">
					<h2> Se connecter </h2>
				</div>

				<?php echo form_open('/connexion/connect'); ?>

					<?php if (session()->has('error')) : ?>
						<p class="text-danger">
							<?= session('error') ?>
						</p>
					<?php endif; ?>

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
					</div>

					
					<br>
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Se connecter',"class='btn w-50 btn-principale'"); ?>
					</div>

				<?php echo form_close(); ?>

				
				<div class="d-flex justify-content-center align-items-center mt-4">
					<a href="/inscription" class="btn btn-link"> Pas de compte ? Inscrivez vous !</a> 
				</div>

				<div class="d-flex justify-content-center align-items-center">
					<a href="connexion/EmailMDP" class="btn btn-link"> Mot de passe oublié ?</a>
				</div>
			</div>
		</div>
	</div>