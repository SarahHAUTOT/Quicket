<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*    v_ ==> Vue (dans le dossier Views)
 *    c_ ==> Controller (dans le dossier Controllers)
 */



$routes->get('/', 'ControllerHome::redirection_home');


// Accessible uniquement a ce qui ne sont pas connecté
$routes->group('', ['filter' => 'guest'], function($routes) {
	// Redirection vers les pages des formulaires
	$routes->get('/inscription'				, 'ControllerUtilisateur::redirection_inscription'			); // (c_ControllerUtilisateur --> v_connexion/Inscription.php)
	$routes->get('/connexion'				, 'ControllerUtilisateur::redirection_connexion'			); // (c_ControllerUtilisateur --> v_connexion/Connexion.php  )
	$routes->get('/connexion/mdp/(:any)'	, 'ControllerUtilisateur::redirection_modificationMDP/$1'	); // (c_ControllerUtilisateur --> v_connexion/ModifMDP.php   )
	$routes->get('/connexion/mdp'			, 'ControllerUtilisateur::mail_Modification'				); // (c_ControllerUtilisateur --> v_connexion/ModifMDP.php   )
	$routes->get('/connexion/EmailMDP'		, 'ControllerUtilisateur::email_mdp'						); // (c_ControllerUtilisateur --> v_connexion/emailMDP.php   )
	
	
	// Traitement des formulaires de connexion/création et d'autre éléments lié au compte
	$routes->match(['get', 'post'], '/connexion/connect'	, 'ControllerUtilisateur::traitement_connexion'  ); // (c_ControllerUtilisateur : traitement_connexion()  )
	$routes->match(['get', 'post'], '/inscription/create'	, 'ControllerUtilisateur::traitement_inscription'); // (c_ControllerUtilisateur : traitement_inscription())
	
	$routes->match(['get', 'post'], '/connexion/mdp/change/(:any)'		, 'ControllerUtilisateur::traitement_modificationMDP/$1'); // (c_ControllerUtilisateur : traitement_inscription())
	$routes->match(['get', 'post'], '/connexion/activation/(:any)'		, 'ControllerUtilisateur::traitement_activation/$1'  ); // (c_ControllerUtilisateur : traitement_inscription())
	$routes->match(['get', 'post'], '/connexion/emailmdp/change'		, 'ControllerUtilisateur::traitement_emailMDPoublie'); // (c_ControllerUtilisateur : traitement_inscription())
	$routes->match(['get', 'post'], '/connexion/emailmdp/change/(:any)'	, 'ControllerUtilisateur::traitement_emailMDPoublie'); // (c_ControllerUtilisateur : traitement_inscription())
	
	$routes->match(['get', 'post'], '/connexion/activation/(:any)', 'ControllerUtilisateur::traitement_activation/$1'  ); // (c_ControllerUtilisateur : traitement_inscription())
});






// Accessible uniquement aux utilisateurs connectés
$routes->group('', ['filter' => 'auth'], function($routes) {

	// Redirection vers la liste des taches
	$routes->get('/taches/(:num)', 'ControllerTaches::redirection_taches/$1'); // (c_ControllerTaches --> v_taches/Taches.php)
	$routes->get('/taches/detail/(:num)', 'ControllerTaches::grosse_tache/$1'); // (c_ControllerTaches --> v_??? )

	$routes->get('/taches/supp/(:num)', 'ControllerTaches::traitement_suppression_tache/$1'); // (c_ControllerTaches  --> v_taches/Taches.php)
    $routes->get('/taches/modif/(:num)', 'ControllerTaches::pis_tache/$1'); // (c_ControllerTaches  --> v_taches/Taches.php)
	$routes->get('/taches/etat/(:num)' , 'ControllerTaches::traitement_etat/$1'     ); // (c_ControllerTaches  --> v_taches/Taches.php)
	$routes->match(['get', 'post'], '/taches/create'             , 'ControllerTaches::traitement_creation_tache'      ); // (c_ControllerTaches  --> v_taches/Taches.php)
	$routes->match(['get', 'post'], '/detailtache/ajoutComm'     , 'ControllerTaches::traitement_creation_comm'       );
	$routes->match(['get', 'post'], '/taches/modifier/(:num)'    , 'ControllerTaches::traitement_modification/$1'     ); // (c_ControllerTaches  --> v_taches/Taches.php)
	
	
	$routes->get('/account', 'ControllerUtilisateur::redirection_compte');
	$routes->match(['get', 'post'], '/account/update', 'ControllerUtilisateur::traitement_modifDonne'); // (c_ControllerTaches  --> v_taches/Taches.php)
	$routes->match(['get', 'post'], '/account/delete', 'ControllerUtilisateur::traitement_delete'    ); // (c_ControllerTaches  --> v_taches/Taches.php)
	
	$routes->get('/planning/', 'ControllerPlanning::redirection_vueGlobale');
	$routes->get('/planning/(:any)', 'ControllerPlanning::redirection_vueGlobale/$1');
	
	$routes->get('/projets', 'ControllerProjet::redirection_projets');
	$routes->match(['get', 'post'], '/projets/create', 'ControllerProjet::traitement_creation'    ); // (c_ControllerTaches  --> v_taches/Taches.php)
	
	// Redirection vers la liste des participants
	$routes->get('/taches/participants/(:num)'              , 'ControllerProjet::redirection_participants/$1');
	$routes->get('/taches/participants/delete/(:num)/(:num)', 'ControllerProjet::traitement_delete_participant/$1/$2');
	$routes->match(['get', 'post'], '/taches/participants/add', 'ControllerUtilisateur::traitement_ajouter_participant'    );

	$routes->get('/deconnect', 'ControllerUtilisateur::traitement_deconnexion');
});

