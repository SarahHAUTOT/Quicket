	<div class="bg">
		<div class="vh-100 d-flex justify-content-center align-items-center">
			<div class="m-5 p-5 border text-align-center rounded form">

				
				<div class="d-flex justify-content-center align-items-center text-center mb-4">
					<h2> Detail de votre compte </h2>
				</div>

				

				

				<?php echo form_open('/account/update'); ?>

					<div class="form-group mb-2">
						<?php echo form_label('Pseudo', 'pseudo'); ?>
						
						<?php echo form_input([
							'name'        => 'pseudo',
							'id'          => 'pseudo',
							'class'       => 'form-control',
							'value'       => set_value('pseudo') == '' ? session()->get('pseudo') :  set_value('pseudo'),
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
							'value'       => set_value('email') == '' ? session()->get('email') :  set_value('email'),
							'required'
						]); ?>

						<?= validation_show_error('email') ?>
					</div>
					
					<br>
					<div class="d-flex justify-content-center align-items-center">
						<?php echo form_submit('submit', 'Modifier mes données',"class='btn px-3 btn-principale'"); ?>
					</div>

				<?php echo form_close(); ?>

				<div class="d-flex justify-content-center align-items-center mt-2">
					<button type="button" class="btn btn-secondaire btn-sm" data-bs-toggle="modal" data-bs-target="#add">
						Supprimer mon compte
					</button>
				</div>
			</div>
		</div>
	</div>





	
	<div class="modal fade <?= session('error') ? 'show' : '' ?>" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="<?= session('error') ? 'false' : 'true' ?>">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Suppression du compte</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>

				<div class="modal-body">

					<p class="small py-1">
						La suppression de votre compte est une action irreversible. <br>
						En supprimant votre compte, l'entierté de vos données, ainsi que vos tâches et commentaires ne seront plus disponible.
					</p>

					<p class="font-weight-bolder mt-2">
						Veillez saisir votre mots de passe afin de supprimer votre compte
					</p>

					<?php echo form_open('/account/delete'); ?>

					<div class="form-group mb-2">
						<?php echo form_input([
							'name'        => 'mdp',
							'id'          => 'mdp',
							'type'        => 'password',
							'class'       => 'form-control',
							'value'       => set_value('mdp'),
							'required'
						]); ?>

						<p class="text-danger"><?= session('error') ?></p>
					</div>

					<br>

					<div class="d-flex justify-content-center align-items-center mt-0 mb-3">
						<?php echo form_submit('submit', 'Supprimer mon compte',"class='btn w-50 btn-principale'"); ?>
					</div>

					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Include Bootstrap 5 Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Si le modal contient des erreurs, on le déclenche
			if (document.querySelector('.modal.show')) {
				const modal = new bootstrap.Modal(document.getElementById('add'));
				modal.show();
			}
		});
	</script>