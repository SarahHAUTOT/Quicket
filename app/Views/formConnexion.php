<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Nouveau compte</title>
</head>
<body>
	<h2>Créer un nouveau compte </h2>
	<?php echo form_open('/userModel'); ?>
	<?php echo form_label('Pseudo', 'nom-pseudo'); ?>
	<?php echo form_input('pseudo', set_value('pseudo'), 'required'); ?>
	<?= validation_show_error('error-username') ?>
	<br>
	<?php echo form_label('Email', 'email'); ?>
	<?php echo form_input('email', set_value('email'), 'required'); ?>
	<?= validation_show_error('error-email') ?>
	<br>
	<?php echo form_label('Mot de passe', 'mdp'); ?>
	<?php echo form_input('mdp', set_value('password'), 'required'); ?>
	<?= validation_show_error('error-mdp') ?>
	<br>
	<?php echo form_label('Confirmation mot de passe', 'mdp-confirmation'); ?>
	<?php echo form_input('mdpConf', set_value('password'), 'required'); ?>
	<?= validation_show_error('error-mdp-conf') ?>
	<br>
	<br>
	<?php echo form_submit('submit', 'Envoyer'); ?>
	<?php echo form_close(); ?>
</body>
</html>