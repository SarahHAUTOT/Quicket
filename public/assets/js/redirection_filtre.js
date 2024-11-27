const titreInput = document.getElementById('titre-recherche')
titreInput.addEventListener('keyup', 
    (event) =>
    {
        if (event.key === 'Enter')
            redirection_recherche()   
    }
);

function redirection_recherche()
{
	
	trierPar = document.getElementById('trier-par').value;	
	ordre    = document.getElementById('ordre').value;	
	titre    = titreInput.value;

	if (!titre || titre.trim().length === 0)
		location.replace("?trierPar=" + trierPar + "&ordre=" + ordre);
	else
		location.replace("?titre=" + titre + "&trierPar=" + trierPar + "&ordre=" + ordre);
}

