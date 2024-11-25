<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*	v_ ==> Vue (dans le dossier Views)
 *	c_ ==> Controller (dans le dossier Controllers)
 */



$routes->get('/', 'ControllerHome::redirection_home');





// Redirection vers les pages des formulaires
$routes->get('/inscription'         , 'ControllerUtilisateur::redirection_inscription'       ); // (c_ControllerUtilisateur --> v_connexion/Inscription.php)
$routes->get('/connexion'           , 'ControllerUtilisateur::redirection_connexion'         ); // (c_ControllerUtilisateur --> v_connexion/Connexion.php  )
$routes->get('/connexion/mdp/(:any)', 'ControllerUtilisateur::redirection_modificationMDP/$1'); // (c_ControllerUtilisateur --> v_connexion/ModifMDP.php   )

// Traitement des formulaires de connexion/création et d'autre éléments lié au compte
$routes->match(['get', 'post'], '/connexion/connect' , 'ControllerUtilisateur::traitement_connexion'  ); // (c_ControllerUtilisateur : traitement_connexion()  )
$routes->match(['get', 'post'], '/inscription/create', 'ControllerUtilisateur::traitement_inscription'); // (c_ControllerUtilisateur : traitement_inscription())

$routes->match(['get', 'post'], '/connexion/mdp'              , 'ControllerUtilisateur::traitement_modificationMDP'); // (c_ControllerUtilisateur : traitement_inscription())
$routes->match(['get', 'post'], '/connexion/activation/(:any)', 'ControllerUtilisateur::traitement_activation/$1'  ); // (c_ControllerUtilisateur : traitement_inscription())

