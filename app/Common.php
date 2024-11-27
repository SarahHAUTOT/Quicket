<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

use Config\Services;

define("__EMAIL0", Services::email());

__EMAIL0->setFrom('quicket.noreply@gmail.com', 'Quicket');

function envoyer_mail(string $mail, string $sujet, string $corps, string $titre, string $lien_btn, string $sous_titre =
""):
bool {
	__EMAIL0->setTo($mail);
	__EMAIL0->setSubject($sujet);
	__EMAIL0->setMessage(
		'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="margin: 0; font-family: Arial, sans-serif; color: black;">
		<div style="height: 100%; display: grid; grid-template-rows: minmax(5%, calc((100% - 376px) / 2)) min-content minmax(5%, calc((100% - 376px) / 2));">
			<div></div>
			<div style="margin: 0 calc(25% / 2); padding: 0 30px; text-align: center; background-color: #f1f1f1; background-image: linear-gradient(46deg, #009a808c, #33ffdc); border-radius: 5px; border: 1px #9A001A solid;">
				<h1 style="margin-bottom: 15px; display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; justify-items: start;">
					<a href="'.base_url().'" target="_blank">
						<img src="https://i.ibb.co/hdV7vnR/Logo-Nom-Horizontal.png" alt="Quicket logo" height="50">
					</a>
					'.$titre.'
				</h1>
				<h2 style="color: #000000d9; margin-top: 0;">'.$sous_titre.'</h2>
				<div>
					<p>'.$corps.'</p>
				</div>
				<a href="'.$lien_btn.'" target="_blank">
					<button style="margin: 35px 0; width: 150px; height: 40px; border: 2px solid #E60026; border-radius: 7.5px; background-color: #E60026; color: #ffd0d0; font-size: medium; cursor: pointer;">Afficher</button>
				</a>
			</div>
			<div></div>
		</div>
	</body>
</html>');
	if (__EMAIL0->send())
		return true;
	echo __EMAIL0->printDebugger();
	return false;
}

function mail_certif_compte(string $mail, string $jeton): bool {
	$lien = site_url("connexion/activation/$jeton");
	return envoyer_mail($mail, "Vérification du compte Quicket", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "Vérification", $lien);
}

function mail_modifier_mdp(string $mail, string $url): bool {
	return envoyer_mail($mail, "Modification du mot de passe Quicket", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua", "Modification de votre mot de passe", $url);
}
