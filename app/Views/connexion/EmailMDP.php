<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center">
			<div class="m-5 p-5 border text-align-center rounded form">

				
				<div class="d-flex justify-content-center align-items-center">
					<h2> Email du compte </h2>
				</div>

				<?php echo form_open('/connexion/emailmdp/change'); ?>


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
					
					<br>
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Envoyer le mail',"class='btn w-70 btn-principale'"); ?>
					</div>

				<?php echo form_close(); ?>

				
				<div class="d-flex justify-content-center align-items-center mt-4">
					<a href="/inscription" class="btn btn-link"> Pas de compte ? Inscrivez vous !</a> 
				</div>
			</div>
		</div>
	</div>