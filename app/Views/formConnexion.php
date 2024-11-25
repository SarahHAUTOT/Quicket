<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Nouveau compte</title>
</head>
<body>
	<h2>Créer un nouveau compte </h2>
	<?php echo form_open('/model'); ?>
	<?php echo form_label('Titre', 'nom-titre'); ?>
	<?php echo form_input('titre', set_value('titre'), 'required'); ?>
	<?= validation_show_error('titre') ?>
	<br>
	<?php echo form_label('Description', 'description'); ?>
	<?php echo form_input('description', set_value('description'), 'required'); ?>
	<?= validation_show_error('description') ?>
	<br>
	<?php echo form_label('Echeange', 'echeange'); ?>
	<?php echo form_input('echeange', set_value('echeange'), 'required'); ?>
	<?= validation_show_error('echeange') ?>
	<br>
	<br>
	<?php echo form_submit('submit', 'Envoyer'); ?>
	<?php echo form_close(); ?>
</body>
</html>