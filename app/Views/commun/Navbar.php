<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="<?=base_url()."assets/css/commun.css";?>">
    <link rel="stylesheet" href="<?=base_url()."assets/css/navbar.css";?>">

	<link rel="shortcut icon" type="image/png" href="<?=base_url()."assets/img/Logoicone.png";?>">
</head>
<body>
	  
  

<!-- NAVBAR -->
	<div class="text-display sticky-top">
		<nav class="navbar navbar-expand-lg navbar-light fixed-top">
			<div class="container-fluid">

				<!-- Icône et nom à gauche -->
				<a class="navbar-brand d-flex align-items-center" href="/">
					<img src="<?=base_url()."assets/img/LogoNomHorizontal.png";?>" alt="Logo" width="auto" height="40" class="d-inline-block align-text-top">
				</a>
			
				<!-- Liens à droite avec redirection -->
    			<?php if (session()->get('isLoggedIn')): ?>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-start text-start" id="navbarNav">
						<ul class="navbar-nav ms-auto">
							
							
							<li class="nav-item">
								<a class="nav-link" id="taches" href="/taches">Taches</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" id="account" href="/account">Mon compte</a>
							</li> 
							
							<li class="nav-item">
								<a class="nav-link" id="deconnect" href="/deconnect">Se déconnecter</a>
							</li> 
						</ul>
					</div>
				<?php else: ?>
					<div class="justify-content-start text-start">
						<a class="nav-link btn btn-principale px-3 py-2" href="/connexion">Se connecter</a>
					</div>
				<?php endif; ?>
			</div>
		</nav>
	</div>

	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()."assets/js/navbar_color_scroll.js";?>"></script>