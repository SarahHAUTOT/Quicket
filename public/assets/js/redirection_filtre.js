function redirection_recherche()
{
	trierPar = document.getElementById('trier-par').value;	
	ordre    = document.getElementById('ordre').value;	
	titre    = document.getElementById('titre-recherche').value;

	if (!titre || titre.trim().length === 0)
		location.replace("?trierPar=" + trierPar + "&ordre=" + ordre);
	else
		location.replace("?titre=" + titre + "&trierPar=" + trierPar + "&ordre=" + ordre);
}

